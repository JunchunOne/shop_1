<?php
namespace Admin\Model;


use Think\Model;

class GoodsListModel extends BaseModel
{

    protected $_validate1 = array(
        array("name", 'require', '名称不能为空！'),
//    array("sn", 'require', '货号不能为空！'),
        array("goods_category_id", 'require', '父分类不能为空！'),
        array("brand_id", 'require', '品牌不能为空！'),
        array("supplier_id", 'require', '供货商不能为空！'),
        array("shop_price", 'require', '本店价格不能为空！'),
        array("market_price", 'require', '市场价格不能为空！'),
        array("stock", 'require', '库存不能为空！'),
//    array("is_on_sale", 'require', '是否上架不能为空！'),
//    array("goods_status", 'require', '商品状态不能为空！'),
        array("keyword", 'require', '关键字不能为空！'),
        array("logo", 'require', 'LOGO不能为空！'),
        array("status", 'require', '状态不能为空！'),
        array("sort", 'require', '排序不能为空！'),
    );

    protected $patchValidate = true;

    //由于添加的数据要做处理,所以要覆盖父类的add方法
    public function add($gatherData)
    {

        //开启事物
        $this->startTrans();//开启事务
        //处理商品状态的数据  调用自己封装的status函数
        $this->goods_status_method($this->data['goods_status']);

        $id = parent::add();  //一定要调用parent上的add,  因为先保存后才有id的值
        if ($id === false) {
            $this->rollback(); //事物回滚
            return false;
        }
        //根据id生成货号
        //>>2.准备货号 并且将货号更新到数据库中       日期+八位的id   20151107000000id
        $sn = date('Ymd') . str_pad($id, 8, "0", STR_PAD_LEFT);
        $result = parent::save(array('sn' => $sn, 'id' => $id));
        if ($result === false) {
            $this->rollback(); //事物回滚
            return false;
        }
        //保存会员的信息
        if(!empty($gatherData['memberprice'])&&!empty($gatherData['member_level_id'])){
            $resultMemberPrice = $this->memberPriceFunction($id, $gatherData['memberprice'],$gatherData['member_level_id']);
            if ($resultMemberPrice === false) {
                return false;
            }
        }
        //保存商品的描述信息
        if (!empty($gatherData['intro'])) {
            $resultIntro = $this->introFunction($id, $gatherData['intro']);
            if ($resultIntro === false) {
                return false;
            }
        }
        //保存上传相册的图片galler
        if (!empty($gatherData['path'])) {
            $resultGaller = $this->gallerFunction($id, $gatherData['path']);
            if ($resultGaller === false) {
                return false;
            }
        }
        //保存上传的文章
        if (!empty($gatherData['article_id'])) {
            $resultArticle = $this->articleFunction($id, $gatherData['article_id']);
            if ($resultArticle === false) {
                return false;
            }
        }
        $this->commit();
        return $id;  //保存成功之后返回i
    }


    //由于修改数据原save方法不能满足所以要覆盖父类的方法
    public function save($gatherData)
    {
        //开启事物
        $this->startTrans();
        //调用封装的函数
        $this->goods_status_method($this->data['goods_status']);

        //保存上传相册的图片galler
        if (!empty($gatherData['path'])) {
            $resultGaller = $this->gallerFunction($this->data['id'], $gatherData['path']);
            if ($resultGaller === false) {
                return false;
            }
        }
        //保存文章信息
        if (!empty($gatherData['article_id'])) {
            $resultArticle = $this->articleFunction($this->data['id'], $gatherData['article_id']);
            if ($resultArticle === false) {
                return false;
            }
        }
        //修改商品描述的信息
        if (!empty($gatherData['intro'])) {
            $resultIntro = $this->introFunction($this->data['id'], $gatherData['intro']);
            if ($resultIntro === false) {
                return false;
            }
        }

        //保存修改后的会员信息
        if(!empty($gatherData['memberprice'])&&!empty($gatherData['member_level_id'])){
            $resultMemberPrice = $this->memberPriceFunction($this->data['id'], $gatherData['memberprice'],$gatherData['member_level_id']);
            if ($resultMemberPrice === false) {
                return false;
            }
        }


        //在调用父类的方法save更新都数据库
        $result = parent::save();
        if ($result === false) {
            //错误 事物回滚
            $this->rollback(); //错误后事物回滚
            return false;
        }
        //事物提交
        $this->commit();
        return $result;
    }

    //封装上传会员信息
    public function memberPriceFunction($id, $memberprice,$member_level_id)
    {
        $memberPriceModel = D('MemberPrice');
        $memberPriceAll = array();
        $memberPriceModel->where(array('goods_id'=>$id))->delete();
        foreach ($memberprice as $key=>$memberpriceVal) {
            $memberPriceAll[] = array('goods_id' => $id, 'price' => $memberpriceVal,'member_level_id'=>$member_level_id[$key]);
        }
        //保存数据到数据库
        $result = $memberPriceModel->addAll($memberPriceAll);

        if ($result === false) {
            $this->rollback(); //事物回滚
            $this->error = '上传会员失败';
            return false;
        }
    }

    //封装上传文章的图片
    public function articleFunction($id, $article)
    {
        $articleModel = D('GoodsArticle');
        $articleAll = array();
        $articleModel->where(array('goods_id'=>$id))->delete();
        foreach ($article as $articleVal) {
            $articleAll[] = array('goods_id' => $id, 'article_id' => $articleVal);
        }
        //保存数据到数据库
        $result = $articleModel->addAll($articleAll);

        if ($result === false) {
            $this->rollback(); //事物回滚
            $this->error = '上传文章失败';
            return false;
        }
    }

    //封装上传相册的图片
    public function gallerFunction($id, $path)
    {
        $gallerModel = D('GoodsGaller');
        $pathAll = array();
        $gallerModel->where(array('goods_id'=>$id))->delete();
        foreach ($path as $pathVal) {
            $pathAll[] = array('goods_id' => $id, 'path' => $pathVal);
        }

        //保存数据到数据库
        $result = $gallerModel->addAll($pathAll);
        if ($result === false) {
            $this->rollback(); //事物回滚
            $this->error = '上传相册失败';
            return false;
        }
    }

    //处理商品状态的有两个地方都用到,所以就提取出来封装成一个函数
    public function goods_status_method($status)
    {
        //处理修改的商品的状态数据
        $good_status = 0;
        $rows = $status;
        foreach ($rows as $val) {
            $good_status = $good_status | $val;
        }
        //把处理的数据放到data里面
        $this->data['goods_status'] = $good_status;
    }

    //封装商品描述函数 由于保存和修改都有使用这个函数,所以保存和修改时都有把当前id对应的数据删除掉.
    public function introFunction($id, $intro)
    {
        //首先使用M得到一个模型对象
        $introModel = D('GoodsIntro');
        //删除当前id对应的数据
        $hh = $introModel->where(array('goods_id' => $id))->delete();
        //把需要的数据添加到数据困
        $resultIntro = $introModel->add(array('goods_id' => $id, 'intro' => $intro));
        //判断返回数据
        if ($resultIntro === false) {
            $this->rollback(); //错误后事物回滚
            $this->error = '商品描述保存失败';
            return false;
        }

    }

}
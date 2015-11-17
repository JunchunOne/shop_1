<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/11/16
 * Time: 17:13
 */

namespace Home\Model;

use Org\Util\String;
use Think\Model;
use Think\Think;

class MemderModel extends Model
{
    public $_auto = array(
        array('add_time', NOW_TIME),
        array('salt', '\Org\Util\String::randString', '', 'function'),
    );

    public function getRow($where)
    {
        $reuslt = $this->where($where)->find();
        //如果数据中存在就返回false 不存在就返回true;ThinkPHP/Library/Vendor/SMS
        if ($reuslt) {
            return false;
        } else {
            return true;
        }
    }

    public function sendSMS($tel)
    {
        //>>1. 随机生成一个数字
        $randomNumber = String::randString(6, 1);
        session('SMS_CODE', $randomNumber);  //为了和用户输入的短信验证码进行验证码
        //>>2.将该数字发送到$tel手机号D:\thinkphp\ThinkPHP\Library\Vendor\SMS
        vendor('SMS.TopSdk');
        $c = new \TopClient();
        date_default_timezone_set('Asia/Shanghai');  //设置时区

        $c->appkey = '23268864';  //创建应用上面的appkey
        $c->secretKey = '69f0728011dec573eb02f3f57583cb80'; //创建应用上面的secretKey
        $req = new \AlibabaAliqinFcSmsNumSendRequest;
        // $req->setExtend("123456");
        $req->setSmsType("normal"); //不改变
        $req->setSmsFreeSignName("注册验证"); //用来验证
        $req->setSmsParam("{'code':'$randomNumber','product':'源代码商城'}");
        $req->setRecNum($tel);   //接收的电话
        $req->setSmsTemplateCode("SMS_2345004"); //模板id
        $resp = $c->execute($req);
        //判定发送的状态
//        return ((string)$resp->result->success)==='true';
         return  $resp->result->success;
    }

    public function add()
    {

        //查询数据库中是否存在着用户名和邮箱
        $where = array('username' => $this->data['username']);
        $reuslt = $this->getRow($where);

        if ($reuslt === false) {
            $this->error = '用户名已经存在';
            return false;
        }
        $where1 = array('emails' => $this->data['emails']);
        $reuslt_1 = $this->getRow($where1);

        if ($reuslt_1 === false) {
            $this->error = '邮箱名已经存在';
            return false;
        }
        //加密加盐
        $this->data['password'] = md5($this->data['password'] . $this->data['salt']);

        return parent::add();
    }
}
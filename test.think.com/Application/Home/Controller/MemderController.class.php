<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/11/16
 * Time: 14:48
 */

namespace Home\Controller;


use Think\Controller;

class MemderController extends Controller
{
    public function hao(){
        du(session('SMS_CODE'));
        phpinfo();
    }
    public function regist()
    {
        $memberModel = D('Memder');
        if (IS_POST) {
            //接收短信验证SMS_CODE
            $Verification=I('post.checkcode');
            if($Verification!=session('SMS_CODE')){
                $this->error('验证码错误');
                return;
            }
//            session('SMS_CODE',null);
            //收集数据 验证数据
            if ($memberModel->create() !== false) {
                //添加数据接收返回知
                $reuslt = $memberModel->add();
                if ($reuslt !== false) {
                    $this->success('注册成功', U('login'));
                    return;
                }
                $this->error('注册失败');
            }

        } else {

            $this->display('regist');
        }
    }
    public function login(){
        $this->display('login');
    }

    public function checks()
    {
        //接收get值
        $name_emil = I('get.');
        //根据get值查询数据库
        $memberModel = D('Memder');
        $result = $memberModel->getRow($name_emil);
        //验证返回结果
        $this->ajaxReturn($result);

    }

    /**发送验证码给这个电话
     * @param $tel
     */
    public function sendSMS($tel){
        $memberModel = D('Memder');
        //发送短信的结果: true或者false
        $result = $memberModel->sendSMS($tel);
        $this->ajaxReturn($result);
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2016/5/15
 * Time: 14:32
 */

namespace Home\Controller;

use Think\Controller;
use Think\Verify;

class UserController extends  Controller{

    public function login(){
        if(IS_GET){
            $this->display();

        }else if(IS_POST){
            $username = I("post.username");
            $password = I("post.password");
            //$verifyCode = I("post.verify");

            //check verify
            /*
            $verify = new Verify();
            if(!$verify->check($verifyCode)){
                $this->error("验证码输入错误",U("User/login"),3);
            }
            */
            //login with username and pwd
            $sql = "select * from employee where username = '%s' and password = '%s' and status = 1";
            $result = M()->query($sql,$username,$password);
            
            if($result){
                $user = $result[0];
                session("user",$user);
                if($user['type']==0){
                    //$this->redirect("Index/index");
                    //$this->show("登录成功");
                    $this->success("管理员登陆成功",U("Index/index"));
                }else{
                   // $this->redirect("Sale/index");
                    $this->success("登陆成功",U("Sale/index"));
                }
            }else{
                //$this->show("用户名或密码错误");
                //$this->display("login");
                $this->error("用户名或密码错误");
            }
        }
    }

    public function logout(){
        session_destroy();
        $this->success("退出成功",U("User/login"),3);
    }

    public function register(){
        if(IS_GET){
            $this->display();
        }
    }

    public function verifyImg(){
        $config = array(
            'imageH'=>40,
            'imageW'=>120,
            'fontttf'=>'4.ttf',
            'fontSize'=>15,
            'length'=>4,
            'useNoise'=>false,
        );
        ob_clean();
        $verify = new Verify($config);
        $verify->entry();
    }
}
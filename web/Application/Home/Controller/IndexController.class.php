<?php
namespace Home\Controller;
use Think\Controller;

class IndexController extends Controller {
    public function index(){
        if(session("user")==NULL){
            $this->redirect("User/login");
        }
        $this->display();
    }

    public function main(){
        $this->display();
    }

    public function help(){
        $this->display();
    }

    public function about(){
        $this->display();
    }

    public function debug(){
        echo phpinfo();
    }
    
}
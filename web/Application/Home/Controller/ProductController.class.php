<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2016/5/15
 * Time: 14:32
 */

namespace Home\Controller;
use Think\Controller;

class ProductController extends Controller{

    public function category(){
        $result = M("Category")->select();
        $this->assign("list",$result);
        $this->display();
    }

    public function add(){
        if(IS_GET){
            $this->display();
        }else if(IS_POST){

        }
    }

    public function  delete($id){
        $this->display();
    }

    public  function  update($id){

    }
}
<?php
/**
 * 自定义类库
 * 
 * User: user
 * Date: 2016/5/17
 * Time: 0:05
 */

function getUserId(){
    return session('user')['id'];
}

function getNow(){
    return date("Y-m-d H:i:s" ,time());
}

function needLogin(){
    $user = session('user');
    if($user==NULL) $this->error("请登录！",U("Index/help"));
}


/*
 * 库存操作共用函数
 */
function findStockPile($stock_house_id,$product_id){
    $StockPile = M('StockPile');
    $condition['stock_house_id']=$stock_house_id;
    $condition['product_id']=$product_id;
    $stockPile=$StockPile->where($condition)->find();//unique
    if($stockPile){//exist
        return $stockPile['id'];
    }
    $stockPile['stock_house_id']=$stock_house_id;
    $stockPile['product_id']=$product_id;
    $stockPile['quantity']=0;
    return $StockPile->add($stockPile);
}

//添加库存，如果不存在则创建，如果存在则增加数量
function IncStockPile($stock_house_id,$product_id,$quantity){
    $StockPile = M('StockPile');
    $id = findStockPile($stock_house_id,$product_id);
    if($id){
        $StockPile->where("id=".$id)->setInc('quantity',$quantity);
    }
    return $id;
}

function DecStockPile($stock_house_id,$product_id,$quantity){
    $StockPile = M('StockPile');
    $id = findStockPile($stock_house_id,$product_id);
    if($id){
        $StockPile->where("id=".$id)->setDec('quantity',$quantity);
    }
    return $id;
}
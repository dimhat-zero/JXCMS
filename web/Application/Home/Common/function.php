<?php
/**
 * 自定义类库
 * 
 * User: user
 * Date: 2016/5/17
 * Time: 0:05
 */

function get_price($price){
    if($price==NULL||$price=="")
        $price="0.0";
    return $price;
}

function get_id($id){
    if($id=="")
        $id=NULL;
    return $id;
}

//分页方法1，已弃用
function getpage(&$m,$where,$pageSize=10){
    $m1=clone $m;//浅复制一个模型
    $count = $m->where($where)->count();//连惯操作后会对join等操作进行重置
    $m=$m1;//为保持在为定的连惯操作，浅复制一个模型
    $p=new Think\Page($count,$pageSize);
    $p->lastSuffix=false;
    $p->rollPage=10;
    $p->setConfig('header','<li class="rows">共<b>%TOTAL_ROW%</b>条记录&nbsp;&nbsp;每页<b>'.$pageSize.'</b>条&nbsp;&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');
    $p->setConfig('prev','上一页');
    $p->setConfig('next','下一页');
    $p->setConfig('last','末页');
    $p->setConfig('first','首页');
    $p->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');

    $p->parameter=I('get.');
    
    $m->limit($p->firstRow,$p->listRows);
    return $p;
}

/*
 * 分页方法2，可
 */
function get_page($total){
    $page=array(
        'total'=>$total,//记录集总数[必须]           
        'url'=>!empty($param['url']) ? $param['url'] : U(__CONTROLLER__),//自定义URL[必须] 

    );
    //$p = new \Org\Util\Myclass\Page($page);
    $p = new \Common\Library\Page($page); //实例化分页类
    return $p;
}
/*
 * 库存操作共用函数
 */
function findStockPile($stock_house_id,$product_id){
    $StockPile = M('StockPile');
    $condition['stock_house_id']=$stock_house_id;
    $condition['product_id']=$product_id;
    $stockPile=$StockPile->find($condition);//unique
    if($stockPile){//exist
        return $stockPile->id;
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
        $StockPile->where("id=".$id).setInc('quantity',$quantity);
    }
    return $id;
}

function DecStockPile($stock_house_id,$product_id,$quantity){
    $StockPile = M('StockPile');
    $id = findStockPile($stock_house_id,$product_id);
    if($id){
        $StockPile->where("id=".$id).setDec('quantity',$quantity);
    }
    return $id;
}
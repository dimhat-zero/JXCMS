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

function getpage(&$m,$where,$pagesize=10){
    $m1=clone $m;//浅复制一个模型
    $count = $m->where($where)->count();//连惯操作后会对join等操作进行重置
    $m=$m1;//为保持在为定的连惯操作，浅复制一个模型
    $p=new Think\Page($count,$pagesize);
    $p->lastSuffix=false;
    $p->setConfig('header','<li class="rows">共<b>%TOTAL_ROW%</b>条记录&nbsp;&nbsp;每页<b>%LIST_ROW%</b>条&nbsp;&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');
    $p->setConfig('prev','上一页');
    $p->setConfig('next','下一页');
    $p->setConfig('last','末页');
    $p->setConfig('first','首页');
    $p->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');

    $p->parameter=I('get.');

    $m->limit($p->firstRow,$p->listRows);

    return $p;
}
<?php

namespace Home\Model;
use Think\Model;

class StockPileModel extends  Model{

    protected  $_validate = array(
        array('stock_house_id','required','请选择仓库！'),
        array('product_id','required','请选择产品'),
        array('stock_house_id','number','请选择仓库！'),
        array('product_id','number','请选择产品'),
        array('quantity','/^(([0-9]+\.[0-9]*[1-9][0-9]*)|([0-9]*[1-9][0-9]*\.[0-9]+)|([0-9]*[1-9][0-9]*))$/',"数量格式不正确",0,'regex'),
    );
}
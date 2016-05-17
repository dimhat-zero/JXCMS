<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2016/5/16
 * Time: 21:12
 */
namespace Home\Model;
use Think\Model;

class ProductModel extends Model{

    protected $_validate=array(
        array('name','require','产品名称必须！'),
        array('name','1,20','产品名称长度1-20！',0,'length'),
        array('category_id','require','产品类别必须！'),
        array('price','currency','价格必须是数字'),
    );

    protected  $_auto=array(
        //array('price','get_price',3,'function'),
        //array('id','get_id',3,'function'),
        //array('price','0.0'),
    );

}
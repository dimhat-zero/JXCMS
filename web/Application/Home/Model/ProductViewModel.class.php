<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2016/5/17
 * Time: 1:13
 */
namespace Home\Model;


use Think\Model\ViewModel;

class ProductViewModel extends ViewModel{
    public $viewFields =array(
        'Product'=>array('*'),
        'Category'=>array('name'=>'category_name','_on'=>'Product.category_id=Category.id')
    );
}
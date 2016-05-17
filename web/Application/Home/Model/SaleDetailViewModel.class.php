<?php

namespace Home\Model;

use Think\Model\ViewModel;

class SaleDetailViewModel extends ViewModel{
	
	public $viewFields = array(
		'SaleDetail'=>array('*'),
		'Product'=>array('name'=>'product_name','_on'=>'SaleDetail.product_id = Product.id'),
	);
}
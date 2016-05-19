<?php

namespace Home\Model;

use Think\Model\ViewModel;

class PurchaseItemViewModel extends ViewModel{
	
	public $viewFields = array(
		'PurchaseItem' => array('*'),
		'Product' => array('name'=>'product_name','unit'=>'product_unit','spec'=>'product_spec','_on'=>'Product.id = PurchaseItem.product_id'),
	);

}
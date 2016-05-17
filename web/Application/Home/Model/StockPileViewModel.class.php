<?php

namespace Home\Model;

use Think\Model\ViewModel;

class StockPileViewModel extends ViewModel{
	
	$viewFields = array(
		'StockPile' => array('*'),
		'StockHouse' => array('name'=>'stock_house_name','_on'=>'StockPile.stock_house_id=StockHouse.id'),
		'Product' => array('name'=>'product_name','_on'=>'StockPile.product_id=Product.id'),
	);
}
<?php

namespace Home\Model;

use Think\Model\ViewModel;

class StockPileViewModel extends ViewModel{
	
	public $viewFields = array(
		'StockPile' => array('*'),
		'StockHouse' => array('name'=>'stock_house_name','_on'=>'StockPile.stock_house_id=StockHouse.id'),
		'ProductView' => array('name'=>'product_name','unit'=>'product_unit','spec'=>'product_spec','category_name'=>'category_name','_on'=>'StockPile.product_id=ProductView.id'),
	);
}
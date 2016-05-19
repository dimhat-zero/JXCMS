<?php

namespace Home\Model;

use Think\Model;

class PurchaseItemModel extends Model{
	protected $_validate = array(
		array('product_id','require',"产品id必须！"),
		array('quantity','require',"采购数量必须！"),
		array('unit_price','require',"采购单价必须！"),
		array('quantity','/^(([0-9]+\.[0-9]*[1-9][0-9]*)|([0-9]*[1-9][0-9]*\.[0-9]+)|([0-9]*[1-9][0-9]*))$/',"采购数量格式不正确",0,'regex'),
		array('unit_price','currency',"采购单价格式不正确"),
	);

	protected $_auto = array(
		array('employee_id','getUserId',3,'function'),
	);
}
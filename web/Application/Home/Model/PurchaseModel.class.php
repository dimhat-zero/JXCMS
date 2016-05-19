<?php

namespace Home\Model;

use Think\Model;

class PurchaseModel extends Model{

	protected $_validate = array(
		//array('employee_id','require','入库人必须！'),
		//array('employee_id','number','请选择入库人'),
		array('stock_house_id','require','入库仓库必须！'),
		array('stock_house_id','number','请选择入库仓库'),
		array('price','require','采购价格必须！'),
		array('price','currency','采购价格格式不正确！')
	);

	protected $_auto = array(
		array('purchase_date','getNow',1,'function'),
		array('employee_id','getUserId',1,'function')
	);
}
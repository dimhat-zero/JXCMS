<?php

namespace Home\Model;

use Think\Model;

class SaleModel extends Model{

	protected $_validate = array(
		array('stock_house_id','require','出库仓库必须！'),
		array('stock_house_id','number','请选择出库仓库'),
		array('price','require','销售价格必须！'),
		array('price','currency','销售价格格式不正确！')
	);

	protected $_auto = array(
		array('sale_date','getNow',1,'function'),
		array('employee_id','getUserId',1,'function')
	);
}
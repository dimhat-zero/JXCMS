<?php

namespace Home\Model;

use Think\Model;

class StockHouseModel extends Model{
	
	protected $_validate = array(
		array('name','require','仓库名称必须！'),
		array('name','2,20','仓库名称长度2-20',0,'length'),
	);
}
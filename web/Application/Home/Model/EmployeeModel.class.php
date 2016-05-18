<?php

namespace Home\Model;

use Think\Model;

class EmployeeModel extends Model{
	protected $_validate = array(
		array('name','require','姓名必须！'),
		array('name','2,6','姓名长度2-6',0,'length'),
		array('username','require','用户名必须！'),
		array('username','2,16','用户名长度2-16',0,'length'),
		array('password','require','密码必须！'),
		array('password','2,16','密码长度2-16',0,'length'),
	);
}
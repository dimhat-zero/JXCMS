<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2016/5/16
 * Time: 20:21
 */

namespace Home\Model;

use Think\Model;

class CategoryModel extends Model{
    protected $_validate = array(
        array('name','require','名称必须！'),
        array('name','1,12','名称长度为1-12！',0,'length'),
    );
}
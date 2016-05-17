<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2016/5/18
 * Time: 0:39
 */
namespace Home\Model;
class Page {
    public $firstRow; // 起始行数
    public $listRows; // 列表每页显示行数
    public $totalRows; // 总行数
    public $totalPages; // 分页总页面数
    public $nowPage = 1;//当前页

    public function __construct($totalRows, $listRows=10){
        $this->totalRows = $totalRows;
        $this->listRows   = $listRows;
        $this->nowPage    = empty($_GET['pageNo']) ? 1 : intval($_GET['pageNo']);
        //calc
        $this->firstRow = $this->listRows * ($this->nowPage - 1);
        $this->totalPages = ceil($this->totalRows / $this->listRows); //总页数
        if(!empty($this->totalPages) && $this->nowPage > $this->totalPages) {
            $this->nowPage = $this->totalPages;
        }
    }
}
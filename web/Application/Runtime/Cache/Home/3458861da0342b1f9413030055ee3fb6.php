<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/Public/css/common.css">
    <link rel="stylesheet" href="/Public/css/main.css">
    <script type="text/javascript" src="/Public/js/jquery.min.js"></script>
    <script type="text/javascript" src="/Public/js/colResizable-1.3.min.js"></script>
    <script type="text/javascript" src="/Public/js/common.js"></script>
    <script type="text/javascript" src="/Public/js/jquery.twbsPagination.js"></script>

    <title>产品管理</title>
</head>
<body>
<div class="container">
    <!--button-->
    <div id="button" class="mt10">
        <a href="/index.php/Home/Product/add">
        <input type="button" name="button" class="btn btn82 btn_add" value="新增">
        </a>
        <input type="button" name="button" class="btn btn82 btn_del" value="删除">
        <input type="button" name="button" class="btn btn82 btn_checked" value="全选">
        <input type="button" name="button" class="btn btn82 btn_nochecked" value="取消">
        <input type="button" name="button" class="btn btn82 btn_export" value="导出">
        <input type="button" name="button" class="btn btn82 btn_search" value="查询">
    </div>
    <!--search bar-->
    <div id="search_bar" class="mt10">
       <div class="box">
          <div class="box_border">
            <div class="box_top"><b class="pl15">搜索</b></div>
            <div class="box_center pt10 pb10">
              <form id="search_form" method="get">
                  <input type="hidden" name="pageNo" id="pageNo" value="<?php echo ((isset($query["pageNo"]) && ($query["pageNo"] !== ""))?($query["pageNo"]):1); ?>">
              <table class="form_table" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td>产品名称</td>
                  <td><input type="text" name="name" value="<?php echo ($query["name"]); ?>" class="input-text lh25" size="10"></td>
                  <td>产品类别</td>
                  <td>
                    <span class="fl">
                      <div class="select_border"> 
                        <div class="select_containers "> 
                        <select name="category_id" class="select">
                            <option value="">全部</option>
                        <?php if(is_array($categorys)): foreach($categorys as $key=>$category): if(($category["id"]) == $query["category_id"]): ?><option value="<?php echo ($category["id"]); ?>" selected><?php echo ($category["name"]); ?> </option>
                            <?php else: ?>
                                <option value="<?php echo ($category["id"]); ?>"><?php echo ($category["name"]); ?></option><?php endif; endforeach; endif; ?>
                        </select> 
                        </div> 
                      </div> 
                    </span>
                  </td>
                </tr>
              </table>
              </form>
            </div>
          </div>
        </div>
    </div>
    <!-- list table -->
    <div id="table" class="mt10" style="width:80%;">
        <div class="box span10 oh">
            <table width="100%" border="0" cellpadding="0" cellspacing="0" class="list_table">
                <tr>
                    <th width="30">#</th>
                    <th width="100">产品名称</th>
                    <th width="100">规格型号</th>
                    <th width="100">产品单位</th>
                    <th width="100">产品类别</th>
                    <th width="100">参考价格</th>
                    <th width="100">操作</th>
                </tr>
                <?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr class="tr">
                    <td class="td_center"><input data-id="<?php echo ($vo["id"]); ?>" name="checkbox" type="checkbox"></td>
                    <td><?php echo ($vo["name"]); ?></td>
                    <td><?php echo ($vo["spec"]); ?></td>
                    <td><?php echo ($vo["unit"]); ?></td>
                    <td><?php echo ($vo["category_name"]); ?></td>
                    <td><?php echo ($vo["price"]); ?></td>
                    <td><a href="/index.php/Home/Product/update/id/<?php echo ($vo["id"]); ?>" class="opa">修改</a></td>
                 </tr><?php endforeach; endif; ?>
            </table>
            <div class="page mt10">
                <div class="pagination" id="jqPagination" style="text-align:center;">

                </div>
            </div>
        </div>
    </div>


</div>
<script type="text/javascript">
$(document).ready(function(){
    $(".btn_del").click(function(){
        if(confirm("确定删除吗？")){
            location = "/index.php/Home/Product/del/ids/"+getCheckboxIds();
        }
    });
    //初始化分页
    $('#jqPagination').twbsPagination({
        totalPages: <?php echo ((isset($query["totalPages"]) && ($query["totalPages"] !== ""))?($query["totalPages"]):1); ?>,
        startPage: <?php echo ((isset($query["pageNo"]) && ($query["pageNo"] !== ""))?($query["pageNo"]):1); ?>,
        visiblePages:7,
        prev:'上一页',
        next:'下一页',
        onPageClick: function (event, page) {
            $('#pageNo').val(page);
            $('#search_form').submit();
        }
    }).append("<div>第<?php echo ((isset($query["pageNo"]) && ($query["pageNo"] !== ""))?($query["pageNo"]):1); ?>页，共有<?php echo ((isset($query["totalPages"]) && ($query["totalPages"] !== ""))?($query["totalPages"]):1); ?>页，<?php echo ($query["totalRows"]); ?>条数据</div>");

});
</script>
</body>
</html>
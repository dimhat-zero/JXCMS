<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/Public/css/common.css">
    <link rel="stylesheet" href="/Public/css/main.css">
    <script type="text/javascript" src="/Public/js/jquery.min.js"></script>
    <script type="text/javascript" src="/Public/js/colResizable-1.3.min.js"></script>
    <script type="text/javascript" src="/Public/js/common.js"></script>

    <title>仓库管理</title>
</head>
<body>
<div class="container">

    <div id="button" class="mt10">
        <a href="/index.php/Home/StockHouse/add">
        <input type="button" name="button" class="btn btn82 btn_add" value="新增">
        </a>
        <input type="button" name="button" class="btn btn82 btn_del" value="删除">
        <input type="button" name="button" class="btn btn82 btn_checked" value="全选">
        <input type="button" name="button" class="btn btn82 btn_nochecked" value="取消">
    </div>

    <div id="table" class="mt10">
        <div class="box span10 oh">
            <table width="100%" border="0" cellpadding="0" cellspacing="0" class="list_table" style="width:30%;">
                <tr>
                    <th width="30">#</th>
                    <th width="100">仓库名称</th>
                    <th width="200">仓库地址</th>
                    <th width="100">操作</th>
                </tr>
                <?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr class="tr">
                    <td class="td_center"><input data-id="<?php echo ($vo["id"]); ?>" name="checkbox" type="checkbox"></td>
                    <td><?php echo ($vo["name"]); ?></td>
                    <td><?php echo ($vo["address"]); ?></td>
                     <td><a href="/index.php/Home/StockHouse/update/id/<?php echo ($vo["id"]); ?>" class="opa">修改</a></td>
                 </tr><?php endforeach; endif; ?>
            </table>

        </div>
    </div>


</div>
<script type="text/javascript">
$(document).ready(function(){
    $(".btn_del").click(function(){
        if(confirm("确定删除吗？")){
            url = "/index.php/Home/StockHouse/del/ids/"+getCheckboxIds();
            location = url;
        }
    });

});
</script>
</body>
</html>
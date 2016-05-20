<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/Public/css/common.css">
    <link rel="stylesheet" href="/Public/css/main.css">
    <script type="text/javascript" src="/Public/js/jquery.min.js"></script>
    <script type="text/javascript" src="/Public/js/colResizable-1.3.min.js"></script>
    <script type="text/javascript" src="/Public/js/common.js"></script>

    <title>员工管理</title>
</head>
<body>
<div class="container">

    <div id="button" class="mt10">
        <a href="/index.php/Home/Employee/add">
        <input type="button" name="button" class="btn btn82 btn_add" value="新增">
        </a>
    </div>

    <div id="table" class="mt10" style="width:60%;">
        <div class="box span10 oh">
            <table width="100%" border="0" cellpadding="0" cellspacing="0" class="list_table">
                <tr>
                    <th width="30">#</th>
                    <th width="100">姓名</th>
                    <th width="100">电话</th>
                    <th width="100">用户名</th>
                    <th width="200">地址</th>
                    <th width="100">操作</th>
                </tr>
                <?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr class="tr">
                    <td class="td_center"><input data-id="<?php echo ($vo["id"]); ?>" name="checkbox" type="checkbox"></td>
                    <td><?php echo ($vo["name"]); ?></td>
                    <td><?php echo ($vo["phone"]); ?></td>
                    <td><?php echo ($vo["username"]); ?></td>
                    <td><?php echo ($vo["address"]); ?></td>
                     <td><a href="/index.php/Home/Employee/update/id/<?php echo ($vo["id"]); ?>" class="opa">修改</a></td>
                 </tr><?php endforeach; endif; ?>
            </table>

        </div>
    </div>


</div>
<script type="text/javascript">
$(document).ready(function(){
    $(".btn_del").click(function(){
        if(confirm("确定删除吗？")){
            url = "/index.php/Home/Employee/del/ids/"+getCheckboxIds();
            location = url;
        }
    });

});
</script>
</body>
</html>
<?php if (!defined('THINK_PATH')) exit();?> <!doctype html>
 <html lang="zh-CN">
 <head>
   <meta charset="UTF-8">
     <link rel="stylesheet" href="/Public/css/common.css">
     <link rel="stylesheet" href="/Public/css/main.css">
     <link rel="stylesheet" href="/Public/css/leanModal.css">
   <script type="text/javascript" src="/Public/js/jquery.min.js"></script>
   <script type="text/javascript" src="/Public/js/colResizable-1.3.min.js"></script>
   <script type="text/javascript" src="/Public/js/common.js"></script>
   <script type="text/javascript" src="/Public/js/jquery.leanModal.min.js"></script>

     <!-- flexigrid -->
     <link rel="stylesheet" type="text/css" href="/Public/css/flexigrid/flexigrid_blue.css">
     <script type="text/javascript" src="/Public/js/flexigrid/flexigrid.js"></script>

   <title>Document</title>
 </head>
 <body>
  <div class="container">

     <div id="forms" class="mt10">
        <div class="box">
          <div class="box_border">
            <div class="box_top"><b class="pl15">
               采购入库详情
            </b></div>
            <div class="box_center">
              <form action="" class="jqtransform" method="post">
                  
               <table class="form_table pt15 pb15" width="100%" border="0" cellpadding="0" cellspacing="0">
                 <tr >
                  <td class="td_right">入库仓库：</td>
                  <td class="">
                    <input type="text" readonly value="<?php echo ($vo["stock_house_name"]); ?>" class="input-text lh30" size="40">
                  </td>
                 </tr>
                 
                <tr >
                  <td class="td_right">入库人：</td>
                  <td class="">
                    <input type="text" readonly value="<?php echo ($vo["employee_name"]); ?>" class="input-text lh30" size="40">
                  </td>
                 </tr>
                 <tr >
                  <td class="td_right">入库时间：</td>
                  <td class="">
                    <input type="text" readonly value="<?php echo ($vo["purchase_date"]); ?>" class="input-text lh30" size="40">
                  </td>
                 </tr>
                
                
               <tr>
                   <td class="td_right">采购总价：</td>
                   <td class="">
                       <input type="text" readonly value="<?php echo ($vo["price"]); ?>" class="input-text lh30" size="40">
                   </td>
               </tr>
               <tr>
                   <td class="td_right">项目：</td>
                   <td class="">
                       <table id="flex" style="display: none"></table>

                   </td>
               </tr>
                 
               </table>
               </form>
            </div>
          </div>
        </div>
     </div>
   </div>



<script type="text/javascript">

$(function(){

  $("#flex").flexigrid({
        url:'/index.php/Home/Purchase/items/id/<?php echo ($vo["id"]); ?>',
        dataType: 'json',
        colModel : colModel ,
        sortname : "id",
        sortorder : "asc",
        title : "商品信息",

        width : 600,
        height : 200
  });
  
});
</script>
<script type="text/javascript" src="/Public/js/myflexigrid.js"></script>
</body>
 </html>
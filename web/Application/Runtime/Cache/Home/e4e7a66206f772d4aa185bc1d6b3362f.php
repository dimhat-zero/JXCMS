<?php if (!defined('THINK_PATH')) exit();?> <!doctype html>
 <html lang="zh-CN">
 <head>
   <meta charset="UTF-8">
   <link rel="stylesheet" href="/Public/css/common.css">
   <link rel="stylesheet" href="/Public/css/main.css">
   <script type="text/javascript" src="/Public/js/jquery.min.js"></script>
   <script type="text/javascript" src="/Public/js/colResizable-1.3.min.js"></script>
   <script type="text/javascript" src="/Public/js/common.js"></script>

   <title>Document</title>
 </head>
 <body>
  <div class="container">

     <div id="forms" class="mt10">
        <div class="box">
          <div class="box_border">
            <div class="box_top"><b class="pl15">
                库存修改
            </b></div>
            <div class="box_center">
              <form action="" class="jqtransform" method="post">
                  <input type="hidden" name="id" value="<?php echo ((isset($vo["id"]) && ($vo["id"] !== ""))?($vo["id"]):0); ?>">
               <table class="form_table pt15 pb15" width="100%" border="0" cellpadding="0" cellspacing="0">
                 <tr>
                  <td class="td_right">仓库名称：</td>
                  <td class="">
                    <input type="text" readonly value="<?php echo ($vo["stock_house_name"]); ?>" class="input-text lh30" size="40">
                  </td>
                </tr>
                 <tr>
                  <td class="td_right">产品名称：</td>
                  <td class="">
                    <input type="text" readonly value="<?php echo ($vo["product_name"]); ?>" class="input-text lh30" size="40">
                  </td>
                </tr>
                <tr >
                  <td class="td_right">产品类别：</td>
                  <td class="">
                    <input type="text" readonly value="<?php echo ($vo["category_name"]); ?>" class="input-text lh30" size="40">
                  </td>
                 </tr>
                 <tr>
                  <td class="td_right">规格型号：</td>
                  <td class=""> 
                    <input type="text" readonly value="<?php echo ($vo["product_spec"]); ?>" class="input-text lh30" size="40">
                  </td>
                </tr>
                <tr>
                  <td class="td_right">产品单位：</td>
                  <td class=""> 
                    <input type="text" readonly value="<?php echo ($vo["product_unit"]); ?>" class="input-text lh30" size="40">
                  </td>
                </tr>
               <tr>
                   <td class="td_right">数量：</td>
                   <td class="">
                       <input type="text" name="quantity" value="<?php echo ($vo["quantity"]); ?>" class="input-text lh30" size="40">
                   </td>
               </tr>
                 <tr>
                   <td class="td_right">&nbsp;</td>
                   <td class="">
                     <input type="submit" name="button" class="btn btn82 btn_save2" value="保存">
                    <input type="reset" name="button" class="btn btn82 btn_res" value="重置">
                   </td>
                 </tr>
               </table>
               </form>
            </div>
          </div>
        </div>
     </div>
   </div> 
 </body>
 </html>
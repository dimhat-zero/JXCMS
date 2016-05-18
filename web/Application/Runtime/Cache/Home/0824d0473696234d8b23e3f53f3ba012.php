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
            <div class="box_top"><b class="pl15">类别新增/修改</b></div>
            <div class="box_center">
              <form action="" method="post" class="jqtransform">
                <input type="hidden" name="id" value="<?php echo ($category["id"]); ?>">
               <table class="form_table pt15 pb15" width="100%" border="0" cellpadding="0" cellspacing="0">
                 <tr>
                  <td class="td_right">类别名称：</td>
                  <td class=""> 
                    <input type="text" name="name" value="<?php echo ($category["name"]); ?>" class="input-text lh30" size="40">
                  </td>
                </tr>
                <tr>
                  <td class="td_right">类别描述：</td>
                  <td class=""> 
                    <input type="text" name="desc" value="<?php echo ($category["desc"]); ?>" class="input-text lh30" size="40">
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
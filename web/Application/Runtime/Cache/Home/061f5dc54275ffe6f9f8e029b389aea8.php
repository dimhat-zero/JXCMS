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
              <?php if(empty($product)): ?>产品新增
                <?php else: ?>
                产品修改<?php endif; ?>
            </b></div>
            <div class="box_center">
              <form action="" class="jqtransform" method="post">
                  <input type="hidden" name="id" value="<?php echo ((isset($product["id"]) && ($product["id"] !== ""))?($product["id"]):0); ?>">
               <table class="form_table pt15 pb15" width="100%" border="0" cellpadding="0" cellspacing="0">
                 <tr>
                  <td class="td_right">产品名称：</td>
                  <td class="">
                    <input type="text" name="name" value="<?php echo ($product["name"]); ?>" class="input-text lh30" size="40">
                  </td>
                </tr>
                <tr >
                  <td class="td_right">产品类别：</td>
                  <td class="">
                    <span class="fl">
                      <div class="select_border">
                        <div class="select_containers ">
                        <select name="category_id" class="select">
                        <?php if(is_array($categorys)): foreach($categorys as $key=>$category): if(($category["id"]) == $product["category_id"]): ?><option value="<?php echo ($category["id"]); ?>" selected><?php echo ($category["name"]); ?></option>
                            <?php else: ?>
                                <option value="<?php echo ($category["id"]); ?>"><?php echo ($category["name"]); ?></option><?php endif; endforeach; endif; ?>
                        </select> 
                        </div> 
                      </div> 
                    </span>
                  </td>
                 </tr>
                 <tr>
                  <td class="td_right">规格型号：</td>
                  <td class=""> 
                    <input type="text" name="spec" value="<?php echo ($product["spec"]); ?>" class="input-text lh30" size="40">
                  </td>
                </tr>
                <tr>
                  <td class="td_right">产品单位：</td>
                  <td class=""> 
                    <input type="text" name="unit" value="<?php echo ($product["unit"]); ?>" class="input-text lh30" size="40">
                  </td>
                </tr>
               <tr>
                   <td class="td_right">参考价格：</td>
                   <td class="">
                       <input type="text" name="price" value="<?php echo ((isset($product["price"]) && ($product["price"] !== ""))?($product["price"]):'0.0'); ?>" class="input-text lh30" size="40">
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
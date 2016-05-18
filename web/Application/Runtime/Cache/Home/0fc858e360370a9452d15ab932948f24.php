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
              <?php if(empty($vo)): ?>员工新增
                  <?php else: ?>
                  员工修改<?php endif; ?>
              </b></div>
            <div class="box_center">
              <form action="" class="jqtransform" method="post">
                <input type="hidden" name="id" value="<?php echo ((isset($vo["id"]) && ($vo["id"] !== ""))?($vo["id"]):0); ?>">
                  
               <table class="form_table pt15 pb15" width="100%" border="0" cellpadding="0" cellspacing="0">
                 <tr>
                  <td class="td_right">员工姓名：</td>
                  <td class=""> 
                    <input type="text" name="name" value="<?php echo ($vo["name"]); ?>" class="input-text lh30" size="40">
                  </td>
                </tr>
                <tr>
                  <td class="td_right">员工用户名：</td>
                  <td class=""> 
                    <input type="text" name="username" value="<?php echo ($vo["username"]); ?>" class="input-text lh30" size="40">
                  </td>
                </tr>
                
                 <tr>
                  <td class="td_right">员工密码：</td>
                  <td class=""> 
                    <input type="text" name="password" value="<?php echo ($vo["password"]); ?>" class="input-text lh30" size="40">
                  </td>
                </tr>
                <tr>
                  <td class="td_right">员工电话：</td>
                  <td class=""> 
                    <input type="text" name="phone" value="<?php echo ($vo["phone"]); ?>" class="input-text lh30" size="40">
                  </td>
                </tr>
                <tr>
                  <td class="td_right">身份证：</td>
                  <td class=""> 
                    <input type="text" name="id_card" value="<?php echo ($vo["id_card"]); ?>" class="input-text lh30" size="40">
                  </td>
                </tr>
                <tr>
                  <td class="td_right">员工地址：</td>
                  <td class=""> 
                    <input type="text" name="address" value="<?php echo ($vo["address"]); ?>" class="input-text lh30" size="40">
                  </td>
                </tr>
            
                <tr >
                  <td class="td_right">员工状态：</td>
                  <td class="">
                    <span class="fl">
                      <div class="select_border">
                        <div class="select_containers ">
                        <select name="status" class="select">
                            <?php if(($vo["status"]) == "0"): ?><option value="1">在职</option>
                                <option value="0" selected>离职</option>
                            <?php else: ?>
                                <option value="1" selected>在职</option>
                                <option value="0">离职</option><?php endif; ?>
                        </foreach>
                        </select> 
                        </div> 
                      </div> 
                    </span>
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
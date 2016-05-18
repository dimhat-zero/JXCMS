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
   <title>Document</title>
 </head>
 <body>
  <div class="container">

     <div id="forms" class="mt10">
        <div class="box">
          <div class="box_border">
            <div class="box_top"><b class="pl15">
               采购入库输单
            </b></div>
            <div class="box_center">
              <form action="" class="jqtransform" method="post">
                  
               <table class="form_table pt15 pb15" width="100%" border="0" cellpadding="0" cellspacing="0">
                 <tr >
                  <td class="td_right">入库仓库：</td>
                  <td class="">
                    <span class="fl">
                      <div class="select_border">
                        <div class="select_containers ">
                        <select name="stock_house_id" class="select">
                        <?php if(is_array($stockHouses)): foreach($stockHouses as $key=>$stockHouse): if(($stockHouse["id"]) == $query["stock_house_id"]): ?><option value="<?php echo ($stockHouse["id"]); ?>" selected><?php echo ($stockHouse["name"]); ?> </option>
                            <?php else: ?>
                                <option value="<?php echo ($stockHouse["id"]); ?>"><?php echo ($stockHouse["name"]); ?></option><?php endif; endforeach; endif; ?>
                        </select> 
                        </div> 
                      </div> 
                    </span>
                  </td>
                 </tr>
                <tr >
                  <td class="td_right">入库人：</td>
                  <td class="">
                    <span class="fl">
                      <div class="select_border">
                        <div class="select_containers ">
                        <select name="employee_id" class="select">
                        <?php if(is_array($employees)): foreach($employees as $key=>$employee): if(($employee["id"]) == $query["employee_id"]): ?><option value="<?php echo ($employee["id"]); ?>" selected><?php echo ($employee["name"]); ?> </option>
                            <?php else: ?>
                                <option value="<?php echo ($employee["id"]); ?>"><?php echo ($employee["name"]); ?></option><?php endif; endforeach; endif; ?>
                        </select> 
                        </div> 
                      </div> 
                    </span>
                  </td>
                 </tr>
                
               <tr>
                   <td class="td_right">采购总价：</td>
                   <td class="">
                       <input type="text" name="price" id="price" value="<?php echo ((isset($product["price"]) && ($product["price"] !== ""))?($product["price"]):'0.0'); ?>" class="input-text lh30" size="40">
                   </td>
               </tr>
               <tr>
                   <td class="td_right">项目：</td>
                   <td class="">
                      <table id="itemTable" class="list_table" style="width:50%" >
                        <tr>
                          <th width="100">产品名称</th>
                          <th width="100">产品数量</th>
                          <th width="100">产品单价</th>
                          <th width="80">操作</th>
                        </tr>
                        <!--
                        <tr><td>产品名称</td><td>产品数量</td><td>产品单价</td><td>操作</td></tr>
                        <tr><td>产品名称</td><td>产品数量</td><td>产品单价</td><td>操作</td></tr>
                        <tr><td>产品名称</td><td>产品数量</td><td>产品单价</td><td>操作</td></tr>
                        <tr><td>产品名称</td><td>产品数量</td><td>产品单价</td><td>操作</td></tr>
                        -->
                      </table>
                   </td>
               </tr>
                 <tr>
                   <td class="td_right">&nbsp;</td>
                   <td class="">
                     <input type="button" name="button" class="btn btn82 btn_save2" value="保存">
                    <input type="reset" name="button" class="btn btn82 btn_res" value="重置">
                    <input type="button" id="addItemBtn" href="#signup" class="btn btn82 btn_config" value="加项目">
                   </td>
                 </tr>
               </table>
               </form>
            </div>
          </div>
        </div>
     </div>
   </div> 


<div id="signup">
  <div id="signup-ct">
        <div id="signup-header">
          <h2>增加采购项目</h2>
          
          <a class="modal_close" href="#"></a>
        </div>
        
        <form action="" id="itemForm">
     
          <div class="txt-fld">
            <label for="">产品</label>
            <select  id="product_id" class="select">
            <?php if(is_array($products)): foreach($products as $key=>$product): ?><option value="<?php echo ($product["id"]); ?>" data-unit="<?php echo ($product["unit"]); ?>" ><?php echo ($product["name"]); ?> </option><?php endforeach; endif; ?>
            </select> 
            
          </div>
          <div class="txt-fld">
            <label for="">单位</label>
            <input id="product_unit" type="text" readonly="" />
          </div>
          <div class="txt-fld">
            <label for="">数量（小数）</label>
            <input id="quantity" type="text" />
          </div>
          <div class="txt-fld">
            <label for="">单价（金额）</label>
            <input id="unit_price"  type="text" />

          </div>
          <div class="btn-fld">
          <button type="button" id="itemAddBtn">确定增加</button>
</div>
          </form>
  </div>
</div>

<script type="text/javascript">

$(function(){
  $('#addItemBtn').leanModal({ top : 200, closeButton: ".modal_close" }); 
  
  //增加单位
  $("#product_id").change(function(){
    $("#product_unit").val($('#product_id option:selected').data('unit'));
  });
  $("#product_id").change();
  //添加项目
  var total_price = 0.0;
  $("#itemAddBtn").click(function(){
    var quantity = $("#quantity").val();
    var unit_price =$("#unit_price").val();
    addOneRow($('#product_id option:selected').text(),quantity,unit_price);
    total_price += quantity*unit_price;
    $("#price").val(total_price);
    $(".modal_close").click();
    $("#itemForm")[0].reset();
  });

  function addOneRow(product_name,quantity,unit_price){
    var trStr= '<tr><td>'+product_name+'</td><td>'+quantity+'</td><td>'+unit_price+'</td><td><button>删除</button></td></tr>';
    $("#itemTable").append(trStr);
  }
});
</script>
</body>
 </html>
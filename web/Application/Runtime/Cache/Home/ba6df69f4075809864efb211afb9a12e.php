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
                 <!--
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
                 -->
                
               <tr>
                   <td class="td_right">采购总价：</td>
                   <td class="">
                       <input type="text" name="price" id="price" value="<?php echo ((isset($product["price"]) && ($product["price"] !== ""))?($product["price"]):'0.0'); ?>" class="input-text lh30" size="40">
                   </td>
               </tr>
               <tr>
                   <td class="td_right">项目：</td>
                   <td class="">
                       <table id="flex" style="display: none"></table>

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

<!-- 增加表单 -->
  <div id="signup">
      <input type="button" id="addItemBtn" href="#signup" class="btn btn82 btn_config" style="display: none;" value="加项目">
      <div id="signup-ct">
          <div id="signup-header">
              <h2>增加采购项目</h2>

              <a class="modal_close" href="#"></a>
          </div>

          <form action="/index.php/Home/Purchase/addItem" id="itemForm">

              <div class="txt-fld">
                  <label for="product_id">产品</label>
                  <select  id="product_id" name="product_id" class="select">
                      <?php if(is_array($products)): foreach($products as $key=>$product): ?><option value="<?php echo ($product["id"]); ?>" data-unit="<?php echo ($product["unit"]); ?>" ><?php echo ($product["name"]); ?> </option><?php endforeach; endif; ?>
                  </select>

              </div>
              <div class="txt-fld">
                  <label for="product_unit">单位</label>
                  <input id="product_unit" type="text" readonly="" />
              </div>
              <div class="txt-fld">
                  <label for="quantity">数量</label>
                  <input id="quantity" name="quantity" value="0.0" type="text" onkeyup="if(isNaN(value))execCommand('undo')" onafterpaste="if(isNaN(value))execCommand('undo')" />
              </div>
              <div class="txt-fld">
                  <label for="unit_price">单价</label>
                  <input id="unit_price" name="unit_price" value="0.0"  type="text" onkeyup="if(isNaN(value))execCommand('undo')" onafterpaste="if(isNaN(value))execCommand('undo')" />
              </div>
              <div class="btn-fld">
                  <button type="button" id="itemAddBtn" style="cursor:pointer">确定增加</button>
              </div>
          </form>
      </div>
  </div>




<script type="text/javascript">
function reloadFlex(){
  $.get('/index.php/Home/Purchase/items',function(data){
    console.log(data);
    if(data.success){
       $("#flex").flexAddData(data);
      $("#price").val(data.totalPrice);
    }else{
      alert(data.error);
    }
   
  });
  
}
function flexAdd(){
  console.log("flex add");
  $('#addItemBtn').click();
}
function flexDel(){
  console.log("flex del");
  selected_count = $('.trSelected').length;
  if (selected_count == 0) {
    alert('请选择一条记录!');
    return;
  }
  names = '';
  $('.trSelected td:nth-child(2) div').each(function(i) {
      if (i) names += ',';
      names += $(this).text();
  });
  ids = '';
  $('.trSelected td:nth-child(1) div').each(function(i) {
    if (i) ids += ',';
    ids += $(this).text();
  });
  console.log(ids,'--',names);
  if (confirm("确定删除商品[" + names + "]?")) {
      $.get('/index.php/Home/Purchase/delItem/ids/'+ids,function(){
        reloadFlex();
      });
   }
}

function flexMod(){
  alert("暂时无法使用");
  return;
   selected_count = $('.trSelected', grid).length;
            if (selected_count == 0) {
              alert('请选择一条记录!');
              return;
            }
            if (selected_count > 1) {
              alert('抱歉只能同时修改一条记录!');
              return;
            }
            data = new Array();
            $('.trSelected td', grid).each(function(i) {
                  data[i] = $(this).children('div').text();
                });
            $('#savegoods input[name="id"]').val(data[0]).attr("readonly","readonly");
            $('#savegoods input[name="name"]').val(data[1]);
            $('#savegoods input[name="stand"]').val(data[2]);
            $('#savegoods input[name="money"]').val(data[3]);
            $('#savegoods input[name="leavings"]').val(data[4]);
            $('#savegoods input[name="orders"]').val(data[5]);
          
           $('#addItemBtn').click();
}


$(function(){

  $("#flex").flexigrid({
        dataType: 'json',
        colModel : colModel ,
        buttons : button,
        sortname : "id",
        sortorder : "asc",
        title : "商品信息",

        width : 600,
        height : 200
  });

  reloadFlex();

  //增加单位
  $("#product_id").change(function(){
      $("#product_unit").val($('#product_id option:selected').data('unit'));
  });
  $("#product_id").change();


  $('#addItemBtn').leanModal({ top : 200, closeButton: ".modal_close" }); 
  

  //添加项目
  var total_price = 0.0;
  $("#itemAddBtn").click(function(){
      $.ajax({
        url:'/index.php/Home/Purchase/addItem',
        data:$("#itemForm").serialize(),
        type : 'POST',
        dataType : 'json',
        success : function(data) {
          if(data.success){
             reloadFlex();
            $(".modal_close").click();
           }else{
             alert(data.error);
           }
           
        }
      });
      //$("#itemForm")[0].reset();
  });

});
</script>
<script type="text/javascript" src="/Public/js/myflexigrid.js"></script>
</body>
 </html>
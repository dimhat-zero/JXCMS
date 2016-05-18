$(function() {
	var colModel = [{
		display : 'ID',
		name : 'id',
		width : 100,// 得加上 要不IE报错
		sortable : true,
		align : 'center'
	}, {
		display : '商品名称',
		name : 'name',
		width : 150,
		sortable : true,
		align : 'center'
	}, {
		display : '单位',
		name : 'stand',
		width : 100,
		sortable : true,
		align : 'center'
	}, {
		display : '数量',
		name : 'money',
		width : 100,
		sortable : true,
		align : 'center'
	}, {
		display : '价格',
		name : 'leavings',
		width : 100,
		sortable : true,
		align : 'center'
	}];

	var button = [{
		name : '添加',
		bclass : 'add',
		onpress : action
	}, {
		// 设置分割线
		separator : true
	}, {
		name : '删除',
		bclass : 'delete',
		onpress : action
	}, {
		separator : true
	}, {
		name : '修改',
		bclass : 'edit',
		onpress : action
	}, {
		separator : true
	}];
	    $("#flex").flexigrid({
				url: '/Public/test.json',
				dataType: 'json',
				colModel : colModel ,
		        buttons : button,
//		        searchitems : [{
//			            display : 'ID',
//			            name : 'id',
//			            isdefault : true
//		            }, {
//			            display : '库存',
//			            name : 'leavings'
//		            }],
		        sortname : "id",
		        sortorder : "asc",

		        title : '商品信息',

		        checkbox : false,// 是否要多选框
		        rowId : 'id',// 多选框绑定行的id


		        width : 700,
		        height : 200
	        });
	    var actions="";

	function action(com, grid) {
		    switch (com) {
			    case '添加' :
					$('#addItemBtn').click();
					//$('#flex').flexAddData(testData);
				    break;
			    case '修改' :
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
					
				   actions="modify.action";

				    $("#goods").jqmShow();
				    break;
			    case '删除' :
				    selected_count = $('.trSelected', grid).length;
				    if (selected_count == 0) {
					    alert('请选择一条记录!');
					    return;
				    }
				    names = '';
				    $('.trSelected td:nth-child(3) div', grid).each(function(i) {
					        if (i)
						        names += ',';
					        names += $(this).text();
				        });
				    ids = '';
				    $('.trSelected td:nth-child(2) div', grid).each(function(i) {
					        if (i)
						        ids += ',';
					        ids += $(this).text();
				        })
				    if (confirm("确定删除商品[" + names + "]?")) {
					    delUser(ids);
				    }
				    break;
		    }
	    }
		
	    function delUser(ids) {
		    $.ajax({
			        url : 'delete.action',
			        data : {
				        ids : ids
			        },
			        type : 'POST',
			        dataType : 'json',
			        success : function() {
				        $('#flex').flexReload();//表格重载
			        }
		        });
	    }
	    $("#submit").click(function(){
	    	 $.ajax({
			        url : actions,
			        data : $("#savegoods").serialize(),
			        type : 'POST',
			        dataType : 'json',
			        success : function(data) {
				    	$("#goods").jqmHide();
				        $('#flex').flexReload();
			        }
		        });
	    })
    });
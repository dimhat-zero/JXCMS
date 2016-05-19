var colModel = [{
	display : 'ID',
	name : 'id',
	width : 80,// 得加上 要不IE报错
	sortable : true,
	align : 'center'
}, {
	display : '商品名称',
	name : 'name',
	width : 150,
	sortable : true,
	align : 'center'
}, {
	display : '规格型号',
	name : 'stand',
	width : 118,
	sortable : true,
	align : 'center'
}, {
	display : '数量',
	name : 'money',
	width : 100,
	sortable : true,
	align : 'center'
}, {
	display : '单价',
	name : 'leavings',
	width : 100,
	sortable : true,
	align : 'center'
}];

var button = [{
	name : '添加',
	bclass : 'add',
	onpress : flexAdd
}, {
	// 设置分割线
	separator : true
}, {
	name : '删除',
	bclass : 'delete',
	onpress : flexDel
}, {
	separator : true
}, {
	name : '修改',
	bclass : 'edit',
	onpress : flexMod
}, {
	separator : true
}];
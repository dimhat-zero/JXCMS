var colModel = [{
	display : '序号',
	name : 'id',
	width : 50,// 得加上 要不IE报错
	sortable : true,
	align : 'center'
}, {
	display : '品名',
	name : 'name',
	width : 150,
	sortable : true,
	align : 'center'
}, {
	display : '规格',
	name : 'product_spec',
	width : 100,
	sortable : true,
	align : 'center'
}, {
	display : '数量',
	name : 'quantity',
	width : 100,
	sortable : true,
	align : 'center'
}, {
	display : '单价',
	name : 'unit_price',
	width : 100,
	sortable : true,
	align : 'center'
}, {
	display : '金额',
	name : 'money',
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
//delete , it no use
var dimhat = (function ($, dimhat){
    var _array = new Array();//项目数组
    //声明项目对象
    function ItemObj(product_id,product_name,product_unit,quantity,unit_price){
        this.product_id = product_id;
        this.product_name = product_name;
        this.product_unit = product_unit;
        this.quantity = quantity;
        this.unit_price = unit_price;
    }

    dimhat.addItem = function(product_id,product_name,product_unit,quantity,unit_price){
        var itemObj = new ItemObj(product_id,product_name,product_unit,quantity,unit_price);
        _array.push(itemObj);
    }

    dimhat.updateItem = function(product_id,product_name,product_unit,quantity,unit_price,index){
        var itemObj = new ItemObj(product_id,product_name,product_unit,quantity,unit_price);
        _array[index] = itemObj;
       // _array.splice(index,1,itemObj);//替换index开始的1个元素
    }

    dimhat.delItem = function(index){
        _array.splice(index,1);//删除index开始的1个元素
    }

    dimhat.getItem = function(index){
        return _array[index];
    }

    dimhat.debug = function(){
        console.log(_array);
    }

    //构建trs
    dimhat.show = function(){
        var str="";
        $.each(_array,function(i,item){
            console.log(item,'--')
            tr = $('<tr>');
            tr.append($('<td>').text(item.product_id));
            tr.append($('<td>').text(item.product_name));
            tr.append($('<td>').text(item.product_unit));
            tr.append($('<td>').text(item.quantity));
            tr.append($('<td>').text(item.unit_price));
            console.log(tr.html());
            str+=tr.html();
        });
        return str;
    }

    //返回json字符串
    dimhat.data = function(){
        var rows = new Array();
        $.each(_array,function(i,item){
            var row = new Object();
            row.id = i;
            row.cell = [i+1,item.product_name,item.product_unit,item.quantity,item.unit_price];
            rows.push(row);
        });
        var result = new Object();
        result.rows = rows;
        //console.log(JSON.stringify(result);
        return result;
    }

    return dimhat;

})(jQuery,window.dm||{});
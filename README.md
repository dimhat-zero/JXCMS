# JXCMS
进销存管理系统
采用thinkphp框架

数据库结构见 jxcms.sql



##数据字段修改日志
能不为空的字段尽量不为空，填写默认值为空字符串
enter_stock -> purchase (purchase_date)
enter_stock_detail -> purchase_item (purchase_id)
sale_detail -> sale_item

quantity -> int(11) double(10,2)

item下的price改成unit_price
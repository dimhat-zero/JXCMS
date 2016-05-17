<?php
/*
|*-------------------------------*|
|  类名：分页扩展插件             |
|*-------------------------------*|
|  Author：Jamlin  QQ:240506779   |
|---------------------------------|
|  Date:   2013-9  For ThinkPHP   |
|  LastUpdate: 2015-9             |
|*-------- www.xeons.cn  --------*|
|    使用请保留作者信息，谢谢     |
|--------------------------------*|
*/
namespace Org\Util\Myclass;
class Page{
 protected	static  $class_name='t_st_in',           //链接按钮样式
	                $just_class_name='just_st_index',//当前页面按钮样式
			        $ajax = false,     //是否采用ajax分页,默认关闭
                    $ajax_out = '',    //AJAX内容输出元素
		        	$url='',           //当前页面
			        $max_rows = 10,    //每页显示数
	                $lastnum = 0,      //最后页数	        
	                $other_url = '',   //其它URL
	                $maxpages = 8,     //页数标签最大值
					$totalrow = 0,     //总记录数
	                $url_name = 'p',   //URL名称
			        $error='',         //错误属性
					$etips=false,      //提示错误信息
					$movetop='',       //点击分页时返回顶部	
					$theme = 0,        //主题				
					$skin = array('#ff6633','red','#cc66ff','#ff6666','#8cd303','#3399ff','#ff9933','#00baba','#4762bb','#006df3','#ff6699','#009900'),//样式颜色
					$url_model = 1,    //URL模式
					$url_model_other = true,//采用url模式2时,是否加载其它参数
					$url_suffix = false,     //是否保留后缀
					$mobile = false;         //采用手机布局
	public  $pagenum;          //URL参数
	public static $tags = array(),   //分页标签数组
	              $pagetext = false; //显示分页信息

	
	//实例化类，$page为数组格式
	
	public function __construct($page=array()){         		 
		 //基本参数
         static::$mobile =!empty($page['mobile'])?true:self::$mobile;//手机布局
         static::$totalrow = !empty($page['total']) ? $page['total'] : 0;
         static::$max_rows = !empty($page['max']) && is_numeric($page['max']) ? $page['max'] : self::$max_rows; //每页最大数为空时默认为10
         static::$maxpages = !empty($page['maxpages']) && is_numeric($page['maxpages']) && $page['maxpages']>2 ? $page['maxpages'] : self::$maxpages;//分布标签数，不能小于2         
         //提示错误信息
		 static::$etips = !empty($page['error']) ? true : self::$etips;
		 //返回顶部
		 static::$movetop  = empty($page['top']) ? '' : '$("html,body").animate({scrollTop:0},400);';
		 //主题
		 static::$skin = !empty($page['skin']) && is_array($page['skin']) ? $page['skin'] : self::$skin;
		 static::$theme = !empty($page['theme']) && is_numeric($page['theme']) && !empty(self::$skin[$page['theme']]) ? $page['theme'] : self::$theme;
		 static::$tags = !empty($page['tags']) ? $page['tags'] : array('<<','<','>','>>');//标签[首页,上一页,下一页,
         //URL参数
         static::$url_name = !empty($page['url_name']) ? $page['url_name'] : self::$url_name;    //URL参数名，默认为p
         $this->pagenum  = !empty($page['pagenum']) ? $page['pagenum'] : I(self::$url_name);         
         static::$url      = !empty($page['url']) ? $page['url'] : __ACTION__;  //当前URL页
		 static::$url_model = !empty($page['url_model']) ? $page['url_model'] : self::$url_model;
		 static::$url_model_other = isset($page['url_model'])?$page['url_model_other']:self::$url_model_other;
		 static::$url_suffix = !empty($page['url_suffix'])?true : self::$url_suffix;
		 static::$pagetext = !empty($page['pagetext']) ? true : self::$pagetext;
         //分页ajax,如果为空，则关闭
		 static::$ajax = !empty($page['ajax']) ? true : self::$ajax;
		 static::$ajax_out = empty($page['ajax']) || empty($page['out']) ? '' : str_replace('#','',$page['out']);	  

		//处理错误信息	 
		if(self::$etips){
		 static::$error = empty($page['total']) ? '<font color="red">The Record Total is Empty!</font>' : '';
		 static::$error = empty(self::$url) ? self::$error.'<font color="red">The URLaddress is Empty!</font>' : self::$error;	
		 static::$error = empty(self::$ajax) && empty(self::$ajax_out) ? self::$error.'This Ajax outDom is Empty,try put out type!' :  self::$error;
		  }
		 static::$lastnum  = ceil(self::$totalrow/self::$max_rows)-1; //总页数（从0开始）         
              //获取URL数组
				foreach ($_GET as $_get_name => $_get_value) {
				   $_get_value=urlencode($_get_value);//中文的URL进行转码				   
					if($_get_name!="_URL_" && $_get_name != self::$url_name){ // 去掉分页参数URL
					 if(self::$url_model==1){
						static::$other_url .= "&{$_get_name}={$_get_value}";
					 }else{
					  static::$other_url[$_get_name]= $_get_value;	 
				   }
			     }				
	          }		
		 
		 
	 }
     
	/*
	 * @ Get Pages 
	 * @ 创建内部函数，获取分页标签
	 * @ Retrun
	 */
	protected  function get_pages(){ 
		
		switch(true){ //获得标签最小值
		  case self::$maxpages>self::$lastnum || $this->pagenum<ceil(self::$maxpages/2):
		  $a=1;
		  break;
		  case $this->pagenum + ceil(self::$maxpages/2)<self::$lastnum+1:
		  $a=  $this->pagenum + 2 - ceil(self::$maxpages/2);
		  break;
		  default:
		  $a=  self::$lastnum+2 - self::$maxpages;
		  break;
		   }
		switch(true){ //获得标签最大值
		  case  self::$maxpages>self::$lastnum || self::$maxpages > self::$lastnum: 
		  $b=self::$lastnum+1;
		  break;
		  case self::$maxpages<=self::$lastnum:
		  switch(true){ 
		  case $this->pagenum+ceil(self::$maxpages/2)>=self::$lastnum+ceil(self::$maxpages/2)-1:
          $b=self::$lastnum+1;$a=self::$lastnum+2-self::$maxpages;
		  break;
		  default:
		  $b=$a+self::$maxpages-1;
		  break;
		    }
			} 
			$pagearray="";
			for($i=$a;$i<=$b;$i++){ //将标签和URL、样式等保存成字符串
			 if($i-1==$this->pagenum){
			$pagearray .=  '<b class="'.self::$just_class_name.'">'.$i.'</b>'; 	
				}else{
				//判断是否为AJAX提交
				 $link = self::$ajax==true ? '<a onclick=page_ajax_'.self::$ajax_out.'("'.self::UrlMerge($i-1).'") >'  : '<a href="'.self::UrlMerge($i-1).'">';
			    //生成链接代码 
				  $pagearray .=  $link.'<b class="'.self::$class_name.'">'.$i.'</b></a>';	  
				  }			
				}
		  //分页类别大于最大标签栏时
		  //头部
		   if($this->pagenum - ceil(self::$maxpages/2)>1&&self::$maxpages<self::$lastnum){
			  //判断是否为AJAX提交
				 $link = self::$ajax==true ? '<a onclick=page_ajax_'.self::$ajax_out.'("'.self::UrlMerge(0).'") >'  : '<a href="'.self::UrlMerge(0).'">';
			    //生成链接代码 
				   $pepend =  $link.'<b class="'.self::$class_name.'">1</b></a>..';   
			 }
			 
		   if(($this->pagenum+ceil(self::$maxpages/2) < self::$lastnum-1)&&self::$maxpages<self::$lastnum){
			  //判断是否为AJAX提交
				 $link = self::$ajax==true ? '<a onclick=page_ajax_'.self::$ajax_out.'("'.self::UrlMerge(self::$lastnum).'") >'  : '<a href="'.self::UrlMerge(self::$lastnum).'">';
			    //生成链接代码 
				   $linkmore = $this->pagenum+ceil(self::$maxpages/2)-1<self::$lastnum-2 ? '..' : '';
				   $addpend =  $linkmore.$link.'<b class="'.self::$class_name.'">'.(self::$lastnum+1).'</b></a>';   
			 }
			return $pepend.$pagearray.$addpend;		 
		}


     //@组合URL
	 static protected function UrlMerge($value){
		if(self::$url_model==1){//参数随后
		  $url = self::$url.'?'.self::$url_name.'='.$value.self::$other_url;	
	     }else{//U模式
		   if(self::$url_model_other)$urldata = self::$other_url;
		   $urldata[self::$url_name] = $value;
		   $url = U(str_replace('.html','',self::$url),$urldata); 
		  }
		  return self::$url_suffix ? $url : str_replace('.html','/',$url);
	    }
	/*
	 * @ Get Limit Min 
	 * @ first data
	 * @ Retrun
	 */
	
	public function pagerows(){
		  return $this->pagenum*self::$max_rows; 
		}
		
    /*
	 * @ Get Limit Max 
	 * @ Last data
	 * @ Retrun
	 */
	public function maxrows(){
		  return self::$max_rows; 
	    }
		
	/*
	 * @ Get Ajax page function
	 * @ JScode require jQuery 1.6+
	 * @ Retrun
	 * @ Static $ajax_out is out put dom 
	 */
	protected static function Pajax(){
	     return  '<script>function page_ajax_'.self::$ajax_out.'(url){if(url!=""){ajaxloading(true,"正在玩命加载中...");$.ajax({type:"get",url:url,async:false,success:function(data){$("#'.self::$ajax_out.'").html(data);'.self::$movetop.';ajaxloading();},error:function(errorThrown){$("#'.self::$ajax_out.'").html(errorThrown);}})}};$(".t_st_in").hover(function(){$(this).css({border:"1px solid #3c3",background:"#c0ffc0"});},function(){$(this).css({border:"1px solid #ccc",background:"white"});});</script>';}
	
    /*
	 * @ Get Pags INTO
	 * @ 访问所有的分页标签(包括第一页、上一页、分页数、下一页、最后一页)
	 * @ Retrun
	 */  
	   
	 public function get_page(){ 
	     //如果系统有错误，跳出函数
	     if(!empty(self::$error)){
		   return self::$error;
		   exit;
		   }
		 // 获得第一页和上一页
		 if($this->pagenum>0){ 
		   //判断是否为AJAX提交
		    $na_href = self::$ajax==true ? '<a onclick=page_ajax_'.self::$ajax_out.'("'.self::UrlMerge(0).'") >' : '<a href="'.self::UrlMerge(0).'">';
			$nb_href = self::$ajax==true ? '<a onclick=page_ajax_'.self::$ajax_out.'("'.self::UrlMerge($this->pagenum-1).'") >' : '<a href="'.self::UrlMerge($this->pagenum-1).'">';
		   //生成链接代码
			$naviga = !self::$mobile ? sprintf('%s<b class="%s">%s</b></a>%s<b class="%s">%s</b></a>',$na_href,self::$class_name,self::$tags[0],$nb_href,self::$class_name,self::$tags[1])
			          : sprintf('%s<b class="%s"><</b></a>',$nb_href,self::$class_name);  
			 }else{ 
			 $naviga = !self::$mobile ? sprintf('<b class="t_st_out">%s</b><b class="t_st_out">%s</b>',self::$tags[0],self::$tags[1]): '<b class="t_st_out"><</b>';
			 }
		 //获得下一页和最后一页
		 if($this->pagenum<self::$lastnum){
			 //判断是否为AJAX提交
			 $next_href =  self::$ajax==true ? '<a onclick=page_ajax_'.self::$ajax_out.'("'.self::UrlMerge($this->pagenum+1).'") >' : '<a href="'.self::UrlMerge($this->pagenum+1).'">';
			 $last_href =  self::$ajax==true ? '<a onclick=page_ajax_'.self::$ajax_out.'("'.self::UrlMerge(self::$lastnum).'") >' : '<a href="'.self::UrlMerge(self::$lastnum).'">';
			 //生成链接代码
			 $next = !self::$mobile ? sprintf('%s<b class="%s">%s</b></a>%s<b class="%s">%s</b></a>',$next_href,self::$class_name,self::$tags[2],$last_href,self::$class_name,self::$tags[3]) : sprintf('%s<b class="%s">></b></a>',$next_href,self::$class_name); 
			 }else{
			   $next = !self::$mobile ? sprintf('<b class="t_st_out">%s</b><b class="t_st_out">%s</b>',self::$tags[2],self::$tags[3]):'<b class="t_st_out">></b>';
			   }
	     //当页数大于1时，输出分页标签
		if(self::$lastnum>0){
		 $ajax_fun = self::$ajax==true ? self::Pajax() : '';//如果为AJAX分页时，输出jsAJAX函数
		 if(!self::$mobile){//非手机布局
		 $totalrow = self::$pagetext?'<b class="t_st_out_last">'.sprintf('%d/%d页&nbsp;共%d条记录',isset($this->pagenum)?$this->pagenum+1:1,self::$lastnum+1,self::$totalrow).'</b>':null;
		 };
		 return !self::$mobile?'<style>.t_st_in{border:1px solid #ccc;margin:2px;padding:5px 10px 5px 10px;font:normal 13px Microsoft Yahei;background:white;color:#333;text-align:center;border-radius:3px;-webkit-border-radius:3px;-moz-border-radius:3px;}.t_st_in:hover{cursor:pointer;text-decoration:none;border:1px solid '.self::$skin[self::$theme].';color:'.self::$skin[self::$theme].'}.just_st_index{border:1px solid '.self::$skin[self::$theme].';border-radius:3px;-webkit-border-radius:3px;-moz-border-radius:3px;background:'.self::$skin[self::$theme].';color:white;margin:2px;padding:5px 10px 5px 10px;font:bold 13px Microsoft Yahei;} a{text-decoration:none;}.t_st_out{border:1px solid #eee;margin:2px;padding:5px 10px 5px 10px;font:normal 13px Microsoft Yahei;color:#ccc;background:white;text-align:center;font-weight:normal}.t_st_out_last{margin:2px;padding:5px 10px 5px 10px;font:normal 13px Microsoft Yahei;background:white;text-align:center;color:#003399;border:1px solid #ccc;}</style>'. $naviga . $this->get_pages() .$next.$totalrow.$ajax_fun
		   : '<style>.t_st_in{border:1px solid #ccc;margin:0.1rem;padding:0.5rem 0.6rem 0.5rem 0.6rem;font:normal 1rem Microsoft Yahei;background:white;color:#333;text-align:center;}.t_st_in:hover{cursor:pointer;text-decoration:none;border:1px solid '.self::$skin[self::$theme].';color:'.self::$skin[self::$theme].'}.just_st_index{background:'.self::$skin[self::$theme].';color:#fff;margin:0.1rem;padding:0.5rem 0.6rem 0.5rem 0.6rem;font:bold 1rem Microsoft Yahei;border:1px solid '.self::$skin[self::$theme].';} a{text-decoration:none;}.t_st_out{border:1px solid #EBEBEB;margin:0.2rem;padding:0.5rem;font:normal 1rem Microsoft Yahei;color:#ccc;background:white;text-align:center;}</style>'. $naviga . $this->get_pages() .$next.$totalrow.$ajax_fun;
		  }
		 }    
  }
	 
?>

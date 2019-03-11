function currentTime(){ 
    var d=new Date(),str='';
    var H = d.getHours(),M=d.getMinutes(),S=d.getSeconds();
    if(H<10){
    	H = '0'+H;
    }
    if(M<10){
    	M = '0'+M;
    }
    if(S<10){
    	S = '0'+S;
    }
    str+=d.getFullYear()+'年'; 
    str+=d.getMonth() + 1+'月'; 
    str+=d.getDate()+'日'; 
    str+=H+'时'; 
    str+=M+'分'; 
    str+=S+'秒'; 
    return str; 
}
var pos = 0;
var dir = 2;
var len = 0;
var t_id = setInterval(animate,20);
$(function(){
	setInterval(function(){$('.time').html(currentTime)},1000);
	$(".nav-list>ul>li").bind("click",function(){
		$(this).siblings("li").find(".submenu").hide();
		$(this).find(".submenu").slideToggle(300);
	});
	$(".submenu li").bind("click",function(){
		$(this).parents("li").siblings("li").children("a").removeClass("on");
		$(this).children("a").addClass("active");
		$(this).siblings("li").children("a").removeClass("active");
		$(this).parents("li").siblings("li").children(".submenu").find("a").removeClass("active");
		$(this).parents(".submenu").show();
		$(this).parents(".submenu").siblings("a").addClass("on");
		return false;
	});
	$(".hide").bind("click",function(){
		$(".left").toggleClass("small");
		var title = $(this).attr("title");
		if(title == '隐藏'){
			$(".right").css("margin-left","55px");
			$(".left-top,.nav-list").hide();
			$(this).attr("title","展开");
			$(this).css("background","url(/images/admin/show.png)");
			$(this).css("left","0px");
		}else{
			$(".right").css("margin-left","190px");
			$(".left-top,.nav-list").show();
			$(this).attr("title","隐藏");
			$(this).css("background","url(/images/admin/hide.png)");
		}
	});
	$(".left").bind("click",function(){
		if($(this).hasClass("small")){
			$(".right").css("margin-left","190px");
			$(this).removeClass("small");
			$(".left-top,.nav-list").show();
			$(".hide").attr("title","隐藏");
			$(".hide").css("background","url(/images/admin/hide.png)");
		}
	});
	$(".iframeurl,#change-password").bind("click",function(){
    	var url = $(this).attr("name");
        var cname = $(this).attr("title");
        $(".next-a").html(cname);
        $("#iframe").attr("src",url).ready();
        var targelem = document.getElementById('loader_container');
		targelem.style.display = 'block';
		targelem.style.visibility = 'visible';
		$("#iframe").hide();
		pos = 0;
		dir = 2;
		len = 0;
		window.clearInterval(t_id);
		t_id = setInterval(animate,20);
    });
});
function animate(){
	var elem = document.getElementById('progress');
	if(elem != null) {
		if (pos==0) len += dir;
		if (len>32 || pos>179) pos += dir;
		if (pos>179) len -= dir;
		if (pos>179 && len==0) pos=0;
		$("#progress").css("left",pos+"px");
		$("#progress").css("width",len+"px");
	}
}
function remove_loading() {
	window.clearInterval(t_id);
	var targelem = document.getElementById('loader_container');
	targelem.style.display = 'none';
	targelem.style.visibility = 'hidden';
	$("#iframe").show();
}
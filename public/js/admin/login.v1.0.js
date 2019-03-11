function hiddenPass(e){
    e = e ? e : window.event;
    var kcode = e.which ? e.which : e.keyCode;
    var pass = document.getElementById("userpwd");
    var j_pass = document.getElementById("pwd");
    if(kcode!=8 && kcode!=13 && kcode!=9){
        var keychar=String.fromCharCode(kcode);
        j_pass.value=j_pass.value+keychar;
        j_pass.value=j_pass.value.substring(0,pass.length);
    }
}
function keyUp(e){
    e = e ? e : window.event;
    var kcode = e.which ? e.which : e.keyCode;
    $("#userpwd").val($("#userpwd").val().replace(/./g,'*'));
    if(kcode==8 || kcode ==9){
        var j_pass = document.getElementById("pwd");
        $("#pwd").val(j_pass.value.substring(0,$("#userpwd").val().length));
    }
}
$(function(){
    $("#myforms").submit(function(){
      var username = $("#username").val();
      var password = $("#userpwd").val();
      var code = $("#code_char").val();
      $(".sub_button").val("验证中...");
      $(".sub_button").css("disabled",'true');
      $.ajax({
          type:'POST',
          url:"<!--{U('login/md5',1)}-->",
          async:false,
          data:{pwd:$("#pwd").val()},
          success:function(data){
            datas = data.replace(/\s/g,'');
            $("#pwd1").val(datas);
          }
      });
      $.ajax({
          type:'POST',
          url:"<!--{U('login/mdname',1)}-->",
          async:false,
          data:{name:username},
          success:function(data){
            $("#username1").val(data);
          }
      });
      $.ajax({
          type:'POST',
          url:"<!--{U('login/mdcode',1)}-->",
          async:false,
          data:{code:code},
          success:function(data){
            $("#code").val(data);
          }
      });
      if(username == ''){
          layer.alert('用户名不能为空',{
                  title: '提示框',       
            icon:0,
          });
          $(".sub_button").val("重新登录");
          $(".sub_button").css("disabled",'');
          return false;
      }else{}
      if(password == ''){
          layer.alert('密码不能为空',{
                  title: '提示框',       
            icon:0,
          });
          $(".sub_button").val("重新登录");
          $(".sub_button").css("disabled",'');
          return false;
      }else{

      }
      if(code == ''){
          layer.alert('验证码不能为空',{
                  title: '提示框',       
            icon:0,
          });
          $(".sub_button").val("重新登录");
          $(".sub_button").css("disabled",'');
          return false;
      }else{
          $(".sub_button").val("登录中...");
          $(".sub_button").css("disabled",'true');
          return true;
      }
    });
});
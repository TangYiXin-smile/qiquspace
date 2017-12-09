<?php

/**
 * @Author: lenovo
 * @Date:   2017-10-22 14:32:26
 * @Last Modified by:   lenovo
 * @Last Modified time: 2017-10-22 19:02:50
 */
include_once '../include/mysql.php';
$id = $_GET['id'];
$sql = "select * from ali_user where user_id=$id";
$res = mysql_query($sql);
$userInfo = mysql_fetch_assoc($res);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="../../assets/vendors/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" href="../../assets/vendors/font-awesome/css/font-awesome.css">
  	<link rel="stylesheet" href="../../assets/vendors/nprogress/nprogress.css">
  	<link rel="stylesheet" href="../../assets/css/admin.css">
  	<script src="../../assets/vendors/nprogress/nprogress.js"></script>
 	<script src="../../assets/vendors/jquery/jquery.min.js"></script>
 	<script src="../../assets/layer/layer.js"></script>
</head>
<body>
	<div class="col-md-4">
      <form id="mainForm" method="post">
        <h2>修改用户信息</h2>
        <input type="hidden" name="id" value="<?=$userInfo['user_id']?>">
        <div class="form-group">
          <label for="email">邮箱</label>
          <input id="email" class="form-control" name="email" type="email" value="<?=$userInfo['user_email']?>">
        </div>
        <div class="form-group">
          <label for="slug">别名</label>
          <input id="slug" class="form-control" name="slug" type="text" value="<?=$userInfo['user_slug']?>">
        </div>
        <div class="form-group">
          <label for="nickname">昵称</label>
          <input id="nickname" class="form-control" name="nickname" type="text" value="<?=$userInfo['user_nickname']?>">
        </div>
        <div class="form-group">
          <label for="password">密码</label>
          <input id="password" class="form-control" name="password" type="text" value="<?=$userInfo['user_pwd']?>">
        </div>
        <div class="form-group">
          <input class="btn btn-primary" type="button" value="修改">
        </div>
      </form>
    </div>

    <script src="../../assets/vendors/jquery/jquery.js"></script>
    <script src="../../assets/vendors/bootstrap/js/bootstrap.js"></script>
    <script>NProgress.done()</script>

    <script>
    	$('.btn-primary').click(function(){
    		var fm = document.getElementById('mainForm');
    		var fd = new FormData(fm);
    		$.ajax({
    			url:'modifyuser.php',
    			type:'post',
    			data:fd,
    			contentType:false,
    			processData:false,
    			success:function(msg){
    				if(msg == 1){
    					alert('修改成功');
    				}else{
    					alert('修改失败');
    				}
    				var index = parent.layer.getFrameIndex(window.name);
    				parent.layer.close(index);
    				parent.location.reload();
    			}
    		});
    	});
    	
    </script>
</body>
</html>
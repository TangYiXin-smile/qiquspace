<?php

/**
 * @Author: lenovo
 * @Date:   2017-10-22 19:26:34
 * @Last Modified by:   lenovo
 * @Last Modified time: 2017-10-22 19:45:23
 */
header('content-type:text/html;charset=utf-8');
$code = $_POST['code'];
$email = $_POST['email'];
$pwd = $_POST['pwd'];
include_once 'include/mysql.php';
session_start();
if($code != $_SESSION['code']){
	echo "验证码错误";
	header('refresh:2;url=login.html');
	die;
}

$sql = "select * from ali_user where user_email='$email'";
$res = mysql_query($sql);
$userInfo = mysql_fetch_assoc($res);
if(md5($pwd) != $userInfo['user_pwd']){
	echo "用户名或密码错误";
	header('refresh:2;url=login.html');
	die;
}else{
	$_SESSION['id'] = $userInfo['user_id'];
	$_SESSION['email'] = $userInfo['user_email'];
	$_SESSION['nickname'] = $userInfo['user_nickname'];
	echo "登录成功";
	header('refresh:2;url=index.html');
}
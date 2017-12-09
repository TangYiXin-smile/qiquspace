<?php

/**
 * @Author: lenovo
 * @Date:   2017-10-22 20:21:07
 * @Last Modified by:   lenovo
 * @Last Modified time: 2017-10-22 20:35:11
 */
header('content-type:text/html;charset=utf-8');
$oldpwd = $_POST['oldpwd'];
session_start();
$id = $_SESSION['id'];
include_once '../include/mysql.php';
$sql = "select * from ali_user where user_id=$id";
$res = mysql_query($sql);
$userInfo = mysql_fetch_assoc($res);
if(md5($oldpwd) != $userInfo['user_pwd']){
	echo "旧密码输入错误";
	header('refresh:2;url=password-reset.php');
	die;
}else{
	if($_POST['newpwd'] != $_POST['re-newpwd']){
		echo "两次密码不一致";
		header('refresh:2;url=password-reset.php');
		die;
	}else{
		$newpwd = md5($_POST['newpwd']);
		$sql = "update ali_user set user_pwd='$newpwd' where user_id=$id";
		$res = mysql_query($sql);
		$num = mysql_affected_rows($link);
		if($num > 0){
			echo "修改密码成功";
			header('refresh:2;url=profile.php');
			die;
		}else{
			echo "修改密码失败";
			header('refresh:2;url=password-reset.php');
			die;
		}
	}
}
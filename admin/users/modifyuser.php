<?php

/**
 * @Author: lenovo
 * @Date:   2017-10-22 18:50:14
 * @Last Modified by:   lenovo
 * @Last Modified time: 2017-10-22 20:01:28
 */
include_once '../include/checksession.php';
include_once '../include/mysql.php';
$id = $_POST['id'];
$email = $_POST['email'];
$slug = $_POST['slug'];
$nickname = $_POST['nickname'];
$password = md5($_POST['password']);
$sql = "update ali_user set user_email='$email',user_slug='$slug',user_nickname='$nickname',user_pwd='$password' where user_id=$id";
$res = mysql_query($sql);
$num = mysql_affected_rows($link);
if($num > 0){
	echo 1;
}else{
	echo 2;
}

?>
<?php

/**
 * @Author: lenovo
 * @Date:   2017-10-22 14:07:39
 * @Last Modified by:   lenovo
 * @Last Modified time: 2017-10-22 20:01:17
 */
$email = $_POST['email'];
$slug = $_POST['slug'];
$nickname = $_POST['nickname'];
$password = $_POST['password'];
include_once '../include/checksession.php';
include_once '../include/mysql.php';
$sql = "insert into ali_user values
(null,'$email','$slug','$nickname','$password','',1)";
mysql_query($sql);
$num = mysql_affected_rows($link);
if($num > 0){
	echo 1;
}else{
	echo 2;
}
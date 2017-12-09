<?php

/**
 * @Author: lenovo
 * @Date:   2017-10-29 20:17:28
 * @Last Modified by:   lenovo
 * @Last Modified time: 2017-10-29 21:25:35
 */
$link = mysql_connect('localhost','root','root');
mysql_query('set names utf8');
mysql_query('use itcast_student');
$name = $_POST['username'];
$pwd = $_POST['password'];
$sql = "select * from my_admin where user_name='$name'";
$res = mysql_query($sql);
$arr = mysql_fetch_assoc($res);
$num = mysql_affected_rows($link);
if($num >0){
	if($pwd == $arr['password']){
		echo json_encode('{"flag":"1"}');
		header('location:http://localhost/user/success.php');
	}
}else{
	echo json_encode('{"flag":"2"}');
	header('location:http://localhost/user/failure.php');
}
?>

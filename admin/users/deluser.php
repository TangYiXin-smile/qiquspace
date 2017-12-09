<?php

/**
 * @Author: lenovo
 * @Date:   2017-10-22 13:24:08
 * @Last Modified by:   lenovo
 * @Last Modified time: 2017-10-22 20:00:51
 */
$id = $_POST['id'];
include_once '../include/checksession.php';
include_once '../include/mysql.php';
$sql = "delete from ali_user where user_id=$id";
mysql_query($sql);
$num = mysql_affected_rows($link);
if($num > 0){
	echo 1;
}else{
	echo 2;
}
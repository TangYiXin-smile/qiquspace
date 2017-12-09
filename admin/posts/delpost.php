<?php

/**
 * @Author: lenovo
 * @Date:   2017-10-23 21:57:58
 * @Last Modified by:   lenovo
 * @Last Modified time: 2017-10-23 22:25:17
 */
include_once '../include/checksession.php';
$id = $_POST['id'];
include_once '../include/mysql.php';
$sql = "delete from ali_post where post_id=$id";
mysql_query($sql);
$num = mysql_affected_rows($link);
if($num > 0){
	echo 1;
}else{
	echo 2;
}

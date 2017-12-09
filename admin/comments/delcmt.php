<?php

/**
 * @Author: lenovo
 * @Date:   2017-10-25 21:54:44
 * @Last Modified by:   lenovo
 * @Last Modified time: 2017-10-25 21:56:03
 */
$id = $_POST['id'];
include_once '../include/mysql.php';
$sql = "delete from ali_comment where cmt_id=$id";
mysql_query($sql);
$num = mysql_affected_rows($link);
if($num > 0){
	echo 1;
}else{
	echo 2;
}
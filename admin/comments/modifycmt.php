<?php

/**
 * @Author: lenovo
 * @Date:   2017-10-25 19:39:38
 * @Last Modified by:   lenovo
 * @Last Modified time: 2017-10-25 19:45:14
 */
$id = $_POST['id'];
$name = $_POST['name'];

include_once '../include/mysql.php';
$sql = "update ali_comment set cmt_state='$name' where cmt_id=$id";
mysql_query($sql);
$num = mysql_affected_rows($link);
if($num > 0){
	echo 1;
}else{
	echo 2;
}
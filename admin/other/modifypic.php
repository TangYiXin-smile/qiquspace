<?php

/**
 * @Author: lenovo
 * @Date:   2017-10-25 21:17:38
 * @Last Modified by:   lenovo
 * @Last Modified time: 2017-10-25 21:20:45
 */
$id = $_POST['id'];
$name = $_POST['name'];

include_once '../include/mysql.php';
$sql = "update ali_pic set pic_state='$name' where pic_id=$id";
mysql_query($sql);
$num = mysql_affected_rows($link);
if($num > 0){
	echo 1;
}else{
	echo 2;
}
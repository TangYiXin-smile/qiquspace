<?php

/**
 * @Author: lenovo
 * @Date:   2017-10-25 21:48:33
 * @Last Modified by:   lenovo
 * @Last Modified time: 2017-10-25 21:50:26
 */
$ids = $_POST['ids'];
include_once '../include/mysql.php';
$sql = "delete from ali_comment where cmt_id in ($ids)";
mysql_query($sql);
$num = mysql_affected_rows($link);
if($num > 0){
	echo 1;
}else{
	echo 2;
}
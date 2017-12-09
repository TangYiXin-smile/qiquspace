<?php

/**
 * @Author: lenovo
 * @Date:   2017-10-25 19:59:18
 * @Last Modified by:   lenovo
 * @Last Modified time: 2017-10-25 20:02:02
 */
$ids = $_POST['ids'];
include_once '../include/mysql.php';
$sql = "update ali_comment set cmt_state='批准' where cmt_id in ($ids)";
mysql_query($sql);
$num = mysql_affected_rows($link);
if($num > 0){
	echo 1;
}else{
	echo 2;
}
<?php

/**
 * @Author: lenovo
 * @Date:   2017-10-20 11:56:46
 * @Last Modified by:   lenovo
 * @Last Modified time: 2017-10-22 19:59:46
 */
header("content-type:text/html;charset=utf-8");
$id = $_GET['id'];
include_once '../include/checksession.php';
include_once '../include/mysql.php';
$sql = "delete from ali_cate where cate_id=$id";
// die($sql);
mysql_query($sql);
$num = mysql_affected_rows($link);
if($num > 0){
	echo "删除成功";
	header("refresh:2;url=categories.php");
}else{
	echo "删除失败";
	header("refresh:2;url=categories.php");
}
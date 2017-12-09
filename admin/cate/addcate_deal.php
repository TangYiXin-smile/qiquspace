<?php

/**
 * @Author: lenovo
 * @Date:   2017-10-20 10:54:26
 * @Last Modified by:   lenovo
 * @Last Modified time: 2017-10-22 19:58:54
 */
header("content-type:text/html;charset=utf-8");
$name = $_POST['name'];
$slug = $_POST['slug'];
$icon = $_POST['icon'];
$status = $_POST['status'];
$show = $_POST['show'];
include_once '../include/checksession.php';
include_once '../include/mysql.php';
$sql = "insert into ali_cate values(null,'$name','$slug','$icon',$status,$show)";
// die($sql);
$res = mysql_query($sql);

$num = mysql_affected_rows($link);
if($num > 0){
	echo "添加分类成功";
	header("refresh:2;url=categories.php");
}else{
	echo "添加分类失败";
	header("refresh:2;url=addcate.php");
}
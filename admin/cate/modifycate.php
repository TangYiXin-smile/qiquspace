<?php

/**
 * @Author: lenovo
 * @Date:   2017-10-20 11:51:35
 * @Last Modified by:   lenovo
 * @Last Modified time: 2017-10-22 20:00:12
 */
header('content-type:text/html;charset=utf-8');
$id = $_POST['id'];
$name = $_POST['name'];
$slug = $_POST['slug'];
$icon = $_POST['icon'];
$status = $_POST['status'];
$show = $_POST['show'];
include_once '../include/checksession.php';
include_once '../include/mysql.php';
$sql = "update ali_cate set cate_name='$name',cate_slug='$slug',cate_class='$icon',cate_status=$status,cate_show=$show where cate_id=$id";
// die($sql);
$res = mysql_query($sql);
$num = mysql_affected_rows($link);
if($num > 0){
	echo '修改成功';
	header('refresh:2;url=categories.php');
}else{
	echo '修改失败';
	header('refresh:2;url=editcate.php?id='.$id);
}
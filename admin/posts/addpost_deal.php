<?php

/**
 * @Author: lenovo
 * @Date:   2017-10-23 18:34:14
 * @Last Modified by:   lenovo
 * @Last Modified time: 2017-10-23 19:52:11
 */
header('content-type:text/html;charset=utf-8');
$title = $_POST['title'];
$content = $_POST['content'];
$slug = $_POST['slug'];
$category = $_POST['category'];
$created = strtotime($_POST['created']);
$status = $_POST['status'];

$desc = substr($content,0,300);
session_start();
$author = $_SESSION['nickname'];
$updtime = $created;
$click = rand(300,800);
$good = rand(200,300);
$bad = rand(5,200);

$upfile_path = "";
if($_FILES['feature']['error']==0){
	$ext = strrchr($_FILES['feature']['name'],'.');
	$upfile_path = '../uploads/'.time().$ext;
	move_uploaded_file($_FILES['feature']['tmp_name'],$upfile_path);
}

include_once '../include/mysql.php';
$sql = "insert into ali_post values 
(null,'$title','$slug','$desc','$content','$author',$category,'$upfile_path',$created,$updtime,$click,$good,$bad,'$status')";
mysql_query($sql);
$num = mysql_affected_rows($link);
if($num > 0){
	echo "添加文章成功";
	header('refresh:2;url=post.php');
}else{
	echo "添加文章失败";
	header('refresh:2;url=addpost.php');
}

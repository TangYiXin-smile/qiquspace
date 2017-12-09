<?php

/**
 * @Author: lenovo
 * @Date:   2017-10-25 14:55:49
 * @Last Modified by:   lenovo
 * @Last Modified time: 2017-10-25 19:29:41
 */
header('content-type:text/html;charset=utf-8');
$id = $_POST['id'];
$title = $_POST['title'];
$content = $_POST['content'];
$slug = $_POST['slug'];
$category = $_POST['category'];
$created = time();
$status = $_POST['status'];

include_once '../include/mysql.php';
$oldpath = '';
$upfile_path = '';
if($_FILES['feature']['error']==0){
	$ext = strrchr($_FILES['feature']['name'],'.');
	$upfile_path = '../uploads/'.time().rand(100,999).$ext;
	move_uploaded_file($_FILES['feature']['tmp_name'],$upfile_path);
	$sql = "select post_file from ali_post where post_id=$id";
	$res = mysql_query($sql);
	$tmp = mysql_fetch_assoc($res);
	$oldpath = $tmp['post_file'];
}

$upfile ='';
if($upfile_path != ''){
	$upfile = ",post_file='$upfile_path'";
}
$sql = "update ali_post set post_title='$title',post_content='$content',post_slug='$slug',post_cateid=$category,post_updtime='$created' $upfile where post_id=$id";
mysql_query($sql);
$num = mysql_affected_rows($link);
if($num > 0){
	if($oldpath != 0){
		unlink($oldpath);
	}
	echo '修改文章成功';
	header('refresh:2;url=posts.php');
}else{
	echo '修改文章失败';
	header('refresh:2;url=editpost.php?id='.$id);
}
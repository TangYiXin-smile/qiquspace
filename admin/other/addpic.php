<?php

/**
 * @Author: lenovo
 * @Date:   2017-10-25 20:42:52
 * @Last Modified by:   lenovo
 * @Last Modified time: 2017-10-25 21:07:44
 */
header('content-type:text/html;charset=utf-8');
$txt = $_POST['text'];
$lk = $_POST['link'];

$upfile_path="";
if($_FILES['image']['error']==0){
	$ext = strrchr($_FILES['image']['name'],'.');
	$upfile_path = '../uploads/'.time().rand(100,999).$ext;
	move_uploaded_file($_FILES['image']['tmp_name'],$upfile_path);
}

include_once '../include/mysql.php';
$sql = "insert into ali_pic (pic_id,pic_path,pic_txt,pic_link) values
(null,'$upfile_path','$txt','$lk')";
mysql_query($sql);
$num = mysql_affected_rows($link);
if($num > 0){
	echo '添加新轮播图片成功';
}else{
	echo '添加新轮播图片失败';
}
header('refresh:2;url=slides.php');
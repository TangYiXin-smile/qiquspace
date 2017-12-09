<?php

/**
 * @Author: lenovo
 * @Date:   2017-10-22 19:56:22
 * @Last Modified by:   lenovo
 * @Last Modified time: 2017-10-22 19:57:54
 */
session_start();
if(empty($_SESSION['id'])){
	echo "请先登录";
	header("refresh:2;url=../login.html");
	die;
}
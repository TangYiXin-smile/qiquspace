<?php

/**
 * @Author: lenovo
 * @Date:   2017-10-20 11:49:36
 * @Last Modified by:   lenovo
 * @Last Modified time: 2017-10-22 19:59:58
 */
header("content-type:text/html;charset=utf-8");
$id = $_GET['id'];
include_once '../include/checksession.php';
include_once '../include/mysql.php';
$sql = "select * from ali_cate where cate_id=$id";
// die($sql);
$res = mysql_query($sql);
$result = mysql_fetch_assoc($res);
// echo '<pre>';
// print_r($result);
// die;
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Categories &laquo; Admin</title>
  <link rel="stylesheet" href="/assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="/assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="/assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="/assets/css/admin.css">
  <script src="/assets/vendors/nprogress/nprogress.js"></script>
</head>
<body>
  <script>NProgress.start()</script>
  <div class="main">
    <?php include_once '../include/nav.php';?>
    <div class="container-fluid">
      <div class="page-title">
        <h1>分类目录</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <div class="col-md-4">
        <form action="modifycate.php" method="post">
          <h2>修改分类目录</h2>
          <input type="hidden" name="id" value="<?=$result['cate_id']?>">
          <div class="form-group">
            <label for="name">名称</label>
            <input id="name" class="form-control" name="name" type="text" value="<?=$result['cate_name'];?>">
          </div>
          <div class="form-group">
            <label for="slug">别名</label>
            <input id="slug" class="form-control" name="slug" type="text" value="<?=$result['cate_slug'];?>">
          </div>
          <div class="form-group">
            <label for="slug">图标</label>
            <input id="slug" class="form-control" name="icon" type="text" value="<?=$result['cate_class'];?>">
          </div>
          <div class="form-group">
            <label for="slug">分类状态</label>
            <input id="slug" name="status" type="radio" value="1" <?=$result['cate_status']==1?'checked':"";?>>启用
            <input id="slug" name="status" type="radio" value="2" <?=$result['cate_status']==2?'checked':"";?>>禁用
          </div>
          <div class="form-group">
            <label for="slug">是否显示</label>
            <input id="slug" name="show" type="radio" value="1" <?=$result['cate_show']==1?'checked':""?>>显示
            <input id="slug" name="show" type="radio" value="2" <?=$result['cate_show']==2?'checked':""?>>不显示
          </div>
          <div class="form-group">
            <button class="btn btn-primary" type="submit">修改</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="aside">
    <?php include_once ("../include/aside.php");?>
  </div>

  <script src="/assets/vendors/jquery/jquery.js"></script>
  <script src="/assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script>NProgress.done()</script>
</body>
</html>
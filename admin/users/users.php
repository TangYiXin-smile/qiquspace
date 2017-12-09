<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Users &laquo; Admin</title>
  <link rel="stylesheet" href="../../assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="../../assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="../../assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="../../assets/css/admin.css">
  <script src="../../assets/vendors/nprogress/nprogress.js"></script>
  <script src="../../assets/vendors/jquery/jquery.min.js"></script>
  <script src="../../assets/layer/layer.js"></script>
</head>
<body>
  <script>NProgress.start()</script>
<?php
include_once '../include/mysql.php';
$pageno = isset($_GET['pageno'])?$_GET['pageno']:1;
$pagesize = 3;
$start = ($pageno-1)*$pagesize;
$sql = "select * from ali_user limit $start,$pagesize";
$res = mysql_query($sql);
?>
  <div class="main">
    <?php 
      include_once '../include/checksession.php';
      include_once '../include/nav.php';
    ?>
    <div class="container-fluid">
      <div class="page-title">
        <h1>用户</h1>
        <input type="button" value="添加用户" onclick="addUser()">
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <div class="row">
        <div class="col-md-8">
          <div class="page-action">
            <!-- show when multiple checked -->
            <a class="btn btn-danger btn-sm" href="javascript:;" style="display: none">批量删除</a>
          </div>
          <table class="table table-striped table-bordered table-hover">
            <thead>
               <tr>
                <th class="text-center" width="40"><input type="checkbox"></th>
                <th class="text-center" width="80">头像</th>
                <th>邮箱</th>
                <th>别名</th>
                <th>昵称</th>
                <th>状态</th>
                <th class="text-center" width="100">操作</th>
              </tr>
            </thead>
            <tbody>
              <?php while($row = mysql_fetch_assoc($res)):?>
                <tr>
                  <td class="text-center"><input type="checkbox"></td>
                  <td class="text-center"><img class="avatar" src="../../assets/img/default.png"></td>
                  <td><?=$row['user_email']?></td>
                  <td><?=$row['user_slug']?></td>
                  <td><?=$row['user_nickname']?></td>
                  <td><?=$row['user_state']?></td>
                  <td class="text-center">
                    <a href="javascript:;" data="<?=$row['user_id']?>" class="edituser btn btn-default btn-xs">编辑</a>
                    <a href="javascript:;" data="<?=$row['user_id']?>" class="deluser btn btn-danger btn-xs">删除</a>
                  </td>
                </tr>
              <?php endwhile;?>
            </tbody>
          </table>
          <?php
            $sql = "select count(*) num from ali_user";
            $res = mysql_query($sql);
            $tmp = mysql_fetch_assoc($res);
            $count = $tmp['num'];
            $pages = ceil($count/$pagesize);
          ?>
          <ul class="pagination pagination-sm pull-right">
            <li><a href="users.php?pageno=1">首页</a></li>
            <?php 
            if($pageno <= 1){
              $prev = 1;
            }else{
              $prev = $pageno-1;
            }
            if($pageno >= $pages){
              $next = $pages;
            }else{
              $next = $pageno+1;
            }
            ?>
            <li><a href="users.php?pageno=<?=$prev?>">上一页</a></li>
            <?php for($i=1;$i<=$pages;$i++):?>
              <li><a href="users.php?pageno=<?=$i?>"><?=$i?></a></li>
            <?php endfor;?>
            <li><a href="users.php?pageno=<?=$next?>">下一页</a></li>
            <li><a href="users.php?pageno=<?=$pages?>">尾页</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <div class="aside">
    <?php include_once '../include/aside.php';?>
  </div>

  <script src="../../assets/vendors/jquery/jquery.js"></script>
  <script src="../../assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script>NProgress.done()</script>

  <script>
    function addUser(){
      layer.ready(function(){ 
        layer.open({
          type: 2,
          title: '添加新用户',
          maxmin: false,
          area: ['600px', '500px'],
          content: 'addUser.html',
        });
      });
    }

    $('.deluser').click(function(){
      var id = $(this).attr("data");
      _this = $(this);
      layer.confirm('您确定要删除吗？',function(){
        $.post('deluser.php',{'id':id},function(msg){
          if(msg == 1){
            layer.alert('删除用户成功');
            _this.parent().parent().remove();
          }else{
            layer.alert('删除用户失败');
          }
        });
      });
    });

    $('.edituser').click(function(){
      var id = $(this).attr('data');
      layer.ready(function(){ 
        layer.open({
          type: 2,
          title: '修改用户信息',
          maxmin: false,
          area: ['600px', '500px'],
          content: 'edituser.php?id='+id,
        });
      });
    })
  </script>
</body>
</html>

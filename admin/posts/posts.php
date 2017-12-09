<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Posts &laquo; Admin</title>
  <link rel="stylesheet" href="../../assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="../../assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="../../assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="../../assets/css/admin.css">
  <script src="../../assets/vendors/nprogress/nprogress.js"></script>
</head>
<body>
  <script>NProgress.start()</script>
<?php 
include_once '../include/checksession.php';
include_once '../include/mysql.php';
$cateid = isset($_GET['cateid'])?$_GET['cateid']:0;
$state = isset($_GET['state'])?$_GET['state']:0;
$where = '';
if($cateid != 0){
  $where .= "cate_id=$cateid and ";
}
if($state != 0){
  $where .= "post_state=$state and ";
}
$where .= 1;
$pageno = isset($_GET['pageno'])?$_GET['pageno']:1;
$pagesize = 3;
$start = ($pageno-1)*$pagesize;
$sql = "select post_id,post_title, user_nickname,cate_name,post_updtime,post_state from ali_post p 
  join ali_cate c on p.post_cateid=c.cate_id 
  join ali_user u on p.post_author=u.user_id
  where $where limit $start,$pagesize";
$res = mysql_query($sql);
?>
  <div class="main">
    <nav class="navbar">
      <button class="btn btn-default navbar-btn fa fa-bars"></button>
      <?php include_once '../include/nav.php';?>
    </nav>
    <div class="container-fluid">
      <div class="page-title">
        <h1>所有文章</h1>
        <a href="post-add.html" class="btn btn-primary btn-xs">写文章</a>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <div class="page-action">
        <!-- show when multiple checked -->
        <a class="btn btn-danger btn-sm" href="javascript:;" style="display: none">批量删除</a>
        <form class="form-inline" action="posts.php" method="get">
          <?php 
          $sql = "select * from ali_cate";
          $cate_res = mysql_query($sql);
          ?>
          <select name="cateid" class="form-control input-sm">
            <option value="0">所有分类</option>
            <?php while($row = mysql_fetch_assoc($cate_res)):?>
              <option value="<?=$row['cate_id']?>" <?php echo ($cateid==$row['cate_id'])?'selected':''?>><?=$row['cate_name']?></option>
            <?php endwhile;?>
          </select>
          <select name="state" class="form-control input-sm">
            <option value="0">所有状态</option>
            <option value="2" <?php echo ($state==2)?'selected':''?>>草稿</option>
            <option value="1" <?php echo ($state==1)?'selected':''?>>已发布</option>
          </select>
          <input id="btn" type="submit" class="btn btn-default btn-sm" value="筛选">
        </form>

<?php
$sql = "select count(*) num from ali_post p 
  join ali_cate c on p.post_cateid=c.cate_id 
  join ali_user u on p.post_author=u.user_id
  where $where ";
  // die($sql);
$num_res = mysql_query($sql);
$tmp = mysql_fetch_assoc($num_res);
$count = $tmp['num'];
$pages = ceil($count/$pagesize);
if($pageno<=1){
  $prev = 1;
}else{
  $prev = $pageno - 1;
}
if($pageno >= $pages){
  $next = $pages;
}else{
  $next = $pageno + 1;
}
?>
        <ul class="pagination pagination-sm pull-right">
          <li><a href="posts.php?cateid=<?=$cateid?>&state=<?=$state?>&pageno=1">首页</a></li>
          <li><a href="posts.php?cateid=<?=$cateid?>&state=<?=$state?>&pageno=<?=$prev?>">上一页</a></li>
          <?php for($i=1;$i<=$pages;$i++):?>
            <li><a href="posts.php?cateid=<?=$cateid?>&state=<?=$state?>&pageno=<?=$i?>"><?=$i?></a></li>
          <?php endfor;?>
          <li><a href="posts.php?cateid=<?=$cateid?>&state=<?=$state?>&pageno=<?=$next?>">下一页</a></li>
          <li><a href="posts.php?cateid=<?=$cateid?>&state=<?=$state?>&pageno=<?=$pages?>">尾页</a></li>
        </ul>
      </div>
      <table class="table table-striped table-bordered table-hover">
        <thead>
          <tr>
            <th class="text-center" width="40"><input type="checkbox"></th>
            <th>标题</th>
            <th>作者</th>
            <th>分类</th>
            <th class="text-center">发表时间</th>
            <th class="text-center">状态</th>
            <th class="text-center" width="100">操作</th>
          </tr>
        </thead>
        <tbody>
          <?php while($row = mysql_fetch_assoc($res)):?>
            <tr>
              <td class="text-center"><input type="checkbox"></td>
              <td><?=$row['post_title']?></td>
              <td><?=$row['user_nickname']?></td>
              <td><?=$row['cate_name']?></td>
              <td class="text-center"><?=$row['post_updtime']?></td>
              <td class="text-center"><?=$row['post_state']?></td>
              <td class="text-center">
                <a href="editpost.php?id=<?=$row['post_id']?>" class="btn btn-default btn-xs">编辑</a>
                <a href="javascript:;" data="<?=$row['post_id'];?>" class="delpost btn btn-danger btn-xs">删除</a>
              </td>
            </tr>
          <?php endwhile;?>
        </tbody>
      </table>
    </div>
  </div>

  <div class="aside">
    <?php include_once '../include/aside.php';?>
  </div>

  <script src="../../assets/vendors/jquery/jquery.js"></script>
  <script src="../../assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script>NProgress.done()</script>
  <script>
    $('.delpost').click(function(){
      var id = $(this).attr('data');
      _this = $(this);
      $.ajax({
        url:'delpost.php',
        data:{id:id},
        success:function(msg){
          if(msg == 2){
            alert('删除文章失败');
          }else{
            _this.parent().parent().remove();
            alert('删除文章成功');
          }
        }
      });
    });
  </script>
</body>
</html>

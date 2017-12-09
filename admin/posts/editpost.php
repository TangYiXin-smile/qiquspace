<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Add new post &laquo; Admin</title>
  <link rel="stylesheet" href="../../assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="../../assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="../../assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="../../assets/css/admin.css">
  <script src="../../assets/vendors/nprogress/nprogress.js"></script>

  <link href="../Ueditor/themes/default/css/umeditor.css" type="text/css" rel="stylesheet">
  <script type="text/javascript" src="../Ueditor/third-party/jquery.min.js"></script>
  <script type="text/javascript" charset="utf-8" src="../Ueditor/umeditor.config.js"></script>
  <script type="text/javascript" charset="utf-8" src="../Ueditor/umeditor.min.js"></script>
  <script type="text/javascript" src="../Ueditor/lang/zh-cn/zh-cn.js"></script>
</head>
<body>
  <script>NProgress.start()</script>
<?php
  include_once '../include/checksession.php';
  include_once '../include/mysql.php';
  $sql = "select * from ali_cate";
  $res = mysql_query($sql);
  
  $id = $_GET['id'];
  $sql1 = "select * from ali_post p 
  join ali_cate c on p.post_cateid=c.cate_id 
  join ali_user u on p.post_author=u.user_id
  where post_id=$id";
  $post_info_res = mysql_query($sql1);
  $post_info_arr = mysql_fetch_assoc($post_info_res);
?>
  <div class="main">
    <?php include_once '../include/nav.php';?>
    <div class="container-fluid">
      <div class="page-title">
        <h1>写文章</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <form class="row" action="modifypost.php" method="post" enctype="multipart/form-data">
        <div class="col-md-9">
        	<input type="hidden" name="id" value="<?=$post_info_arr['post_id']?>">
          <div class="form-group">
            <label for="title">标题</label>
            <input id="title" class="form-control input-lg" name="title" type="text" value="<?=$post_info_arr['post_title']?>">
          </div>
          <div class="form-group">
            <label for="content">内容</label>
            <textarea id="content" name="content"><?=$post_info_arr['post_content']?></textarea>
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label for="slug">别名</label>
            <input id="slug" class="form-control" name="slug" type="text" value="<?=$post_info_arr['post_slug']?>">
            <p class="help-block">https://zce.me/post/<strong>slug</strong></p>
          </div>
          <div class="form-group">
            <label for="feature">特色图像</label>
            <!-- show when image chose -->
            <img class="help-block thumbnail" style="display: none">
            <input id="feature" class="form-control" name="feature" type="file">
          </div>
          <div class="form-group">
            <label for="category">所属分类</label>
            <select id="category" class="form-control" name="category">
              <option value="0">未分类</option>
              <?php while($row = mysql_fetch_assoc($res)):?>
                <option value="<?=$row['cate_id']?>" <?php echo ($post_info_arr['post_cateid']==$row['cate_id'])?"selected":"";?>><?=$row['cate_name']?></option>
              <?php endwhile;?>
            </select>
          </div>
          <div class="form-group">
            <label for="created">发布时间</label>
            <input id="created" class="form-control" name="created" type="datetime-local">
          </div>
          <div class="form-group">
            <label for="status">状态</label>
            <select id="status" class="form-control" name="status">
            <?php if($post_info_arr['post_state']==2):?>
              <option value="2" selected>草稿</option>
              <option value="1">已发布</option>
          	<?php else:?>
          	  <option value="2">草稿</option>
              <option value="1" selected>已发布</option>
          	<?php endif;?>
            </select>
          </div>
          <div class="form-group">
            <input class="btn btn-primary" type="submit" value="保存">
          </div>
        </div>
      </form>
    </div>
  </div>

  <div class="aside">
    <?php include_once '../include/aside.php';?>
  </div>


  <script src="../../assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script>NProgress.done()</script>
  <script>
    var um = UM.getEditor('content',{
      initialFrameWidth:850,
      initialFrameHeight:300,
      initialContent:'文章内容'
    });
  </script>
</body>
</html>

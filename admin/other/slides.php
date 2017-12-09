<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Slides &laquo; Admin</title>
  <link rel="stylesheet" href="../../assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="../../assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="../../assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="../../assets/css/admin.css">
  <script src="../../assets/vendors/nprogress/nprogress.js"></script>
</head>
<body>
  <?php 
  include_once '../include/checksession.php';
  include_once '../include/mysql.php';
  $sql = "select * from ali_pic";
  $res = mysql_query($sql);
  ?>
  <script>NProgress.start()</script>

  <div class="main">
    <?php include_once '../include/nav.php';?>
    <div class="container-fluid">
      <div class="page-title">
        <h1>图片轮播</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <div class="row">
        <div class="col-md-4">
          <form action="addpic.php" method="post" enctype="multipart/form-data">
            <h2>添加新轮播内容</h2>
            <div class="form-group">
              <label for="image">图片</label>
              <!-- show when image chose -->
              <img class="help-block thumbnail" style="display: none">
              <input id="image" class="form-control" name="image" type="file">
            </div>
            <div class="form-group">
              <label for="text">文本</label>
              <input id="text" class="form-control" name="text" type="text" placeholder="文本">
            </div>
            <div class="form-group">
              <label for="link">链接</label>
              <input id="link" class="form-control" name="link" type="text" placeholder="链接">
            </div>
            <div class="form-group">
              <button class="btn btn-primary" type="submit">添加</button>
            </div>
          </form>
        </div>
        <div class="col-md-8">
          <div class="page-action">
            <!-- show when multiple checked -->
            <a class="btn btn-danger btn-sm" href="javascript:;" style="display: none">批量删除</a>
          </div>
          <table class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                <th class="text-center" width="40"><input type="checkbox"></th>
                <th class="text-center">图片</th>
                <th>文本</th>
                <th>状态</th>
                <th class="text-center" width="120">操作</th>
              </tr>
            </thead>
            <tbody>
              <?php while($row = mysql_fetch_assoc($res)):?>
              <tr>
                <td class="text-center"><input type="checkbox"></td>
                <td class="text-center"><img class="slide" src="<?=$row['pic_path']?>"></td>
                <td><?=$row['pic_txt']?></td>
                <td class="state"><?=$row['pic_state']?></td>
                <td class="text-center">
                  <?php if($row['pic_state']=='显示'):?>
                    <a href="javascript:;" data="<?=$row['pic_id']?>" class="btn btnpic btn-warning btn-xs">不显示</a>
                    <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
                  <?php else:?>
                    <a href="javascript:;" data="<?=$row['pic_id']?>" class="btn btnpic btn-info btn-xs">显示</a>
                    <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
                  <?php endif;?>
                </td>
              </tr>
              <?php endwhile;?>
            </tbody>
          </table>
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
    $('.btnpic').click(function(){
      var id = $(this).attr('data');
      var name = $(this).html();
      _this = $(this);
      $.post('modifypic.php',{id:id,name:name},function(msg){
        if(msg == 1){
          _this.parent().parent().find('.state').html(name);
          if(name == '显示'){
            _this.removeClass('btn-info').addClass('btn-warning').html('不显示');
          }else{
            _this.removeClass('btn-warning').addClass('btn-info').html('显示');
          }
          alert('修改成功');
        }else{
          alert('修改失败');
        }
      });
    });
  </script>
</body>
</html>

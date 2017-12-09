<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Comments &laquo; Admin</title>
  <link rel="stylesheet" href="../../assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="../../assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="../../assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="../../assets/css/admin.css">
  <script src="../../assets/vendors/nprogress/nprogress.js"></script>
</head>
<body>
  <?php 
  include_once '../include/mysql.php';
  $sql = "select cmt_id,member_nickname,cmt_content,post_title,
  cmt_time,cmt_state from ali_comment c
  join ali_member m on c.cmt_memid=m.member_id
  join ali_post p on c.cmt_postid=p.post_id";
  $res = mysql_query($sql);
  ?>
  <script>NProgress.start()</script>
<?php include_once '../include/checksession.php';?>
  <div class="main">
    <?php include_once '../include/nav.php';?>
    <div class="container-fluid">
      <div class="page-title">
        <h1>所有评论</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <div class="page-action">
        <!-- show when multiple checked -->
        <div class="btn-batch" style="display: block">
          <button id="allow" class="btn btn-info btn-sm">批量批准</button>
          <button id="refuse" class="btn btn-warning btn-sm">批量拒绝</button>
          <button id="delete" class="btn btn-danger btn-sm">批量删除</button>
        </div>
        <ul class="pagination pagination-sm pull-right">
          <li><a href="#">上一页</a></li>
          <li><a href="#">1</a></li>
          <li><a href="#">2</a></li>
          <li><a href="#">3</a></li>
          <li><a href="#">下一页</a></li>
        </ul>
      </div>
      <table class="table table-striped table-bordered table-hover">
        <thead>
          <tr>
            <th class="text-center" width="40"><input id="max" type="checkbox"></th>
            <th>作者</th>
            <th>评论</th>
            <th>评论在</th>
            <th>提交于</th>
            <th>状态</th>
            <th class="text-center" width="100">操作</th>
          </tr>
        </thead>
        <tbody>
          <?php while($row = mysql_fetch_assoc($res)):?>
          <tr class="danger">
            <td class="text-center"><input type="checkbox" value="<?=$row['cmt_id']?>"></td>
            <td><?=$row['member_nickname'];?></td>
            <td><?=$row['cmt_content'];?></td>
            <td><?=$row['post_title'];?></td>
            <td><?=$row['cmt_time'];?></td>
            <td class="state"><?=$row['cmt_state'];?></td>
            <td class="text-center">
              <?php if($row['cmt_state']=='批准'):?>
                <a href="javascript:;" data="<?=$row['cmt_id']?>" class="btn btncmt btn-warning btn-xs">驳回</a>
                <a href="javascript:;" data="<?=$row['cmt_id']?>" class="btn delbtn btn-danger btn-xs">删除</a>
              <?php else:?>
                <a href="javascript:;" data="<?=$row['cmt_id']?>" class="btn btncmt  btn-info btn-xs">批准</a>
                <a href="javascript:;" data="<?=$row['cmt_id']?>" class="btn delbtn btn-danger btn-xs">删除</a> 
              <?php endif;?>
            </td>
          </tr>
          <?php endwhile;?>
        </tbody>
      </table>
    </div>
  </div>

  <div class="aside">
    <?php include_once ("../include/aside.php");?>
  </div>

  <script src="../../assets/vendors/jquery/jquery.js"></script>
  <script src="../../assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script>NProgress.done()</script>
  <script>
    $('.btncmt').click(function(){
      var id = $(this).attr('data');
      var name = $(this).html();
      _this = $(this);
      $.post('modifycmt.php',{id:id,name:name},function(msg){
        if(msg == 1){
          _this.parent().parent().find('.state').html(name);
          if(name == '批准'){
            _this.removeClass('btn-info').addClass('btn-warning').html('驳回');
          }else{
            _this.removeClass('btn-warning').addClass('btn-info').html('批准');
          }
          alert('修改成功');
        }else{
          alert('修改失败');
        }
      });
    });
    $('.delbtn').click(function(){
      var id = $(this).attr('data');
      _this = $(this);
      $.post('delcmt.php',{id:id},function(msg){
        if(msg == 1){
          alert('删除成功');
          _this.parent().parent().remove();
        }else{
          alert('删除失败');
        }
      });
    });
    $('#allow').click(function(){
      var checkbox_list = $(':checkbox:checked');
      var str ='';
      checkbox_list.each(function(index,el){
        str += el.value + ',';
      });
      str = str.substr(0,str.length-1);
      $.post('modify_cmts.php',{ids:str},function(msg){
        if(msg == 1){
          checkbox_list.each(function(){
            $(this).parent().parent().find('.state').html('批准');
            $(this).parent().parent().find('.btncmt').removeClass('btn-info').addClass('btn-warning').html('驳回');
          });
        }
      });
    });
    $('#refuse').click(function(){
      var checkbox_list = $(':checked');
      var str ='';
      checkbox_list.each(function(index,el){
        str += el.value+",";
      });
      str = str.substr(0,str.length-1);
      $.post('refusecmt.php',{ids:str},function(msg){
        if(msg == 1){
          checkbox_list.each(function(){
            $(this).parent().parent().find('.state').html('驳回');
            $(this).parent().parent().find('.btncmt').removeClass('btn-warning').addClass('btn-info').html('批准');
          });
        }
      });
    });
    $('#delete').click(function(){
      var checkbox_list = $(':checked');
      var str = '';
      checkbox_list.each(function(index,el){
        str += el.value + ',';
      });
      str = str.substr(0,str.length-1);
      $.post('deletelotcmt.php',{ids:str},function(msg){
        if(msg == 1){
          checkbox_list.each(function(){
            $(this).parent().parent().remove();
          });
          alert('删除成功');
        }else{
          alert('删除失败');
        }
      });
    });
  </script>
</body>
</html>

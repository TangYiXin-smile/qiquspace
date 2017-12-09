<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>阿里百秀-发现生活，发现美!</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/vendors/font-awesome/css/font-awesome.css">
</head>
<body>
  <div class="wrapper">
    <div class="topnav">
      <ul>
        <li><a href="javascript:;"><i class="fa fa-glass"></i>奇趣事</a></li>
        <li><a href="javascript:;"><i class="fa fa-phone"></i>潮科技</a></li>
        <li><a href="javascript:;"><i class="fa fa-fire"></i>会生活</a></li>
        <li><a href="javascript:;"><i class="fa fa-gift"></i>美奇迹</a></li>
      </ul>
    </div>
    <?php 
    include_once 'left.php';
    $id = $_GET['id'];
    $sql ="select post_content,cate_name,post_title,user_nickname,post_updtime,
    post_desc,post_click,post_good,num,post_file 
    from ali_cate c 
    join ali_post p on c.cate_id=p.post_cateid
    join ali_user u on p.post_author=u.user_id
    join (select cmt_postid,count(*) num from ali_comment group by cmt_postid) tmp
    on tmp.cmt_postid=p.post_id
    where cate_id=$id";
    $res = mysql_query($sql);
    $row = mysql_fetch_assoc($res);
    ?>
    <div class="content">
      <div class="article">
        <div class="breadcrumb">
          <dl>
            <dt>当前位置：</dt>
            <dd><a href="javascript:;"><?=$row['cate_name'];?></a></dd>
          </dl>
        </div>
        <h2 class="title">
          <a href="javascript:;"><?=$row['post_title'];?></a>
        </h2>
        <div class="meta">
          <span><?=$row['user_nickname'];?> 发布于 <?=date('Y-m-d',$row['post_updtime']);?></span>
          <span>分类: <a href="javascript:;"><?=$row['cate_name'];?></a></span>
          <span>阅读: (<?=$row['post_click'];?>)</span>
          <span>评论: (<?=$row['num'];?>)</span>
        </div>
        <div><?=htmlspecialchars_decode($row['post_content']);?></div>
      </div>
      <div class="panel hots">
        <h3>热门推荐</h3>
        <ul>
          <li>
            <a href="javascript:;">
              <img src="uploads/hots_2.jpg" alt="">
              <span>星球大战:原力觉醒视频演示 电影票68</span>
            </a>
          </li>
          <li>
            <a href="javascript:;">
              <img src="uploads/hots_3.jpg" alt="">
              <span>你敢骑吗？全球第一辆全功能3D打印摩托车亮相</span>
            </a>
          </li>
          <li>
            <a href="javascript:;">
              <img src="uploads/hots_4.jpg" alt="">
              <span>又现酒窝夹笔盖新技能 城里人是不让人活了！</span>
            </a>
          </li>
          <li>
            <a href="javascript:;">
              <img src="uploads/hots_5.jpg" alt="">
              <span>实在太邪恶！照亮妹纸绝对领域与私处</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="footer">
      <p>© 2016 XIU主题演示 本站主题由 themebetter 提供</p>
    </div>
  </div>
</body>
</html>

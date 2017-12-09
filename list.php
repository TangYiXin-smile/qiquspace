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
    $name = $_GET['name'];
    $sql = "select post_id,post_title,user_nickname,post_updtime,
    post_desc,post_click,post_good,num,post_file 
    from ali_cate c 
    join ali_post p on c.cate_id=p.post_cateid
    join ali_user u on p.post_author=u.user_id
    join (select cmt_postid,count(*) num from ali_comment group by cmt_postid) tmp
    on tmp.cmt_postid=p.post_id
    where cate_id=$id";
    $post_res = mysql_query($sql);

    ?>
    <div class="content">
      <div class="panel new">
        <h3><?=$name?></h3>
        <?php while($row = mysql_fetch_assoc($post_res)):?>
        <div class="entry">
          <div class="head">
            <a href="detail.php?id=<?=$row['post_id']?>"><?=$row['post_title']?></a>
          </div>
          <div class="main">
            <p class="info"><?=$row['user_nickname']?> 发表于 <?=$row['post_updtime']?></p>
            <p class="brief"><?=$row['post_desc']?></p>
            <p class="extra">
              <span class="reading">阅读(<?=$row['post_click']?>)</span>
              <span class="comment">评论(<?=$row['num']?>)</span>
              <a href="javascript:;" class="like">
                <i class="fa fa-thumbs-up"></i>
                <span>赞(<?=$row['post_good']?>)</span>
              </a>
              <a href="javascript:;" class="tags">
                分类：<span>星球大战</span>
              </a>
            </p>
            <a href="javascript:;" class="thumb">
              <img src="/admin/upload/<?=$row['post_file']?>" alt="">
            </a>
          </div>
        </div>
        <?php endwhile;?>
      </div>
    </div>
    <div class="footer">
      <p>© 2016 XIU主题演示 本站主题由 themebetter 提供</p>
    </div>
  </div>
</body>
</html>

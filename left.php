<?php

/**
 * @Author: lenovo
 * @Date:   2017-10-26 14:04:15
 * @Last Modified by:   lenovo
 * @Last Modified time: 2017-10-26 20:58:10
 */
include_once 'admin/include/mysql.php';
$sql = "select * from ali_cate where cate_show=1";
$cate_res = mysql_query($sql);

?>
<div class="header">
  <h1 class="logo"><a href="index.html"><img src="assets/img/logo.png" alt=""></a></h1>
  <ul class="nav">
    <?php while($row = mysql_fetch_assoc($cate_res)):?>
      <li><a href="list.php?id=<?=$row['cate_id']?>&name=<?=$row['cate_name']?>"><i class="fa <?=$row['cate_class']?>"></i><?=$row['cate_name']?></a></li>
    <?php endwhile;?>
  </ul>
  <div class="search">
    <form>
      <input type="text" class="keys" placeholder="输入关键字">
      <input type="submit" class="btn" value="搜索">
    </form>
  </div>
  <div class="slink">
    <a href="javascript:;">链接01</a> | <a href="javascript:;">链接02</a>
  </div>
</div>
<div class="aside">
  <div class="widgets">
    <h4>搜索</h4>
    <div class="body search">
      <form>
        <input type="text" class="keys" placeholder="输入关键字">
        <input type="submit" class="btn" value="搜索">
      </form>
    </div>
  </div>
  <div class="widgets">
    <h4>随机推荐</h4>
    <?php 

    $sql = "select * from ali_post order by rand() limit 0,5";
    $post_res = mysql_query($sql);

    ?>
    <ul class="body random">
      <?php while($row = mysql_fetch_assoc($post_res)):?>
        <li>
          <a href="javascript:;">
            <p class="title"><?=$row['post_title']?></p>
            <p class="reading"><?=$row['post_click']?></p>
            <div class="pic">
              <img src="/admin/uploads/<?=$row['post_file']?>" alt="">
            </div>
          </a>
        </li>
      <?php endwhile;?>
      
    </ul>
  </div>
  <div class="widgets">
    <h4>最新评论</h4>
    <?php 
    $sql = "select * from ali_comment c 
    join ali_member m on c.cmt_memid=m.member_id
    join ali_post p on c.cmt_postid=p.post_id 
    order by cmt_time desc
    limit 0,6";
    $cmt_res = mysql_query($sql);

    ?>
    <ul class="body discuz">
      <?php while($row = mysql_fetch_assoc($cmt_res)):?>
        <li>
          <a href="javascript:;">
            <div class="avatar">
              <img src="/admin/upload/<?=$row['post_file']?>" alt="">
            </div>
            <div class="txt">
              <p>
                <span><?=$row['member_nickname'];?></span>9个月前(<?=date('m-d',$row['cmt_time']);?>)说:
              </p>
              <p><?=$row['cmt_content']?></p>
            </div>
          </a>
        </li>
      <?php endwhile;?>
    </ul>
  </div>
</div>
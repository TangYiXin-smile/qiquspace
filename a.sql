/*
* @Author: lenovo
* @Date:   2017-10-19 15:38:45
* @Last Modified by:   lenovo
* @Last Modified time: 2017-10-25 20:15:12
*/
create table ali_cate(
cate_id int unsigned auto_increment primary key,
cate_name varchar(10) unique not null comment '分类名称',
cate_slug varchar(10) unique not null comment '分类别名',
cate_class varchar(10) unique not null comment '分类图标',
cate_status tinyint not null default 1 comment '分类状态：1 启用状态，2 禁用状态',
cate_show tinyint not null default 1 comment '是否显示分类：1 显示 2 不显示'
)engine=myisam default charset=utf8;


insert into ali_cate values
	(null,'潮科技','tec','fa-phone',1,1),
	(null,'奇趣事','funny','fa-glass',1,1);

insert into ali_cate values
	(null,'会生活','','fa-',1,1),
	(null,'','','fa-',1,1);


create table ali_user(
user_id int unsigned auto_increment primary key,
user_email varchar(30) unique not null comment '用户名、用户邮箱',
user_slug varchar(30) unique not null comment '用户别名',
user_nickname varchar(30) unique not null comment '用户昵称',
user_passwd char(32) not null comment '用户密码，md5加密',
user_pic varchar(100) not null comment '用户头像',
user_state tinyint not null default 1 comment '用户状态 1：激活 2：未激活'
)engine=myisam default charset=utf8;


create table ali_post(
post_id int unsigned auto_increment primary key,
post_title varchar(30) unique not null comment '文章标题',
post_slug varchar(30) not null unique comment '文章别名'，
post_desc varchar(255)  not null comment '文章摘要',
post_content text not null comment '文章内容'，
post_author int not null comment '作者id，和user表的user_id字段关联',
post_catedid int not null comment '分类id，和cate表的cate_id字段关联',
post_addtime int unsigned not null comment '文章发布时间',
post_updtime int unsigned not null comment '文章修改时间',
post_click int unsigned not null comment '点击量',
post_good int unsigned not null comment '赞数量',
post_bad int unsigned not null comemnt '踩数量',
post_state enum('草稿','已发布') not null default '草稿' comment '文章状态',
post_file varchar(100) not null default '' comment '文章封面图片路径'


);


create table ali_pic(
pic_id int unsigned auto_increment primary key,
pic_path varchar(100) not null comment '上传文件保存路径',
pic_txt varchar(20) not null comment '文本标题',
pic_link varchar(20) not null comment '文件链接地址',
pic_state enum('显示','不显示') not null default '不显示'
)engine=myisam default charset = utf8;
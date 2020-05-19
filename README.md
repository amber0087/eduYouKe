eduYouke在线教育点播系统
===============


## 环境要求

> 运行环境要求PHP7.1+ ,

> 开启静态重写 ,

> 要求环境支持pathinfo ,

> PDO PHP Extension  ,

> MBstring PHP Extension ,

> CURL PHP Extension 。

## 安装

~~~

git clone

composer install

导入SQL文件 public/databases/install.sql

配置 .env文件
[DATABASE]
HOSTNAME = 127.0.0.1
DATABASE = xxx
USERNAME = root
PASSWORD = root

写入权限
/public/storage
/runtime

nginx配置
location / {
   if (!-e $request_filename) {
   		rewrite  ^(.*)$  /index.php?s=/$1  last;
    }
}
~~~

## 视频加密
https://help.aliyun.com/document_detail/68613.html?spm=a2c4g.11186623.2.30.50e66a6aR1CiJS


## 演示



[演示地址](https://edu.lixuqi.com/admin)
[账号密码 eduYouke--123456]


## 交流群

<img src="http://swechat-img.oss-cn-beijing.aliyuncs.com/38d2f17ef648d385dda5d38af2818088.png" width="300" height="300">



<?php
/*************************************************
 * 文件名：/config/config.php
 * 功能：     配制文件
 * 版本：      1.0
 * 日期：     2016-06-06 16:18:12
 * 作者：    JoeXiong
 * 版权：     Copyright © 2016-2016 quwancn.com All Rights Reserved
 */
// Cookie 设置
define("_COOKIE_PRE_", "77f1d96b046392785ab4af26465937e7"); // Cookie 前缀
define("_COOKIE_DOMAIN_", ".joeshop.cn"); // Cookie 作用域
                                         
// 数据表前缀
define('_DB_PRE_', "joe_");             
                    
// 数据库配置参数
global $db_config;
$db_config = array(
    'host' => '127.0.0.1',
    'port' => 3306,
    'username' => 'root',
    'password' => '',
    'dbname' => 'joe_db',
    'charset' => 'utf8'
);


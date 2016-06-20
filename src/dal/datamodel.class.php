<?php

/*************************************************
 * 文件名：datamodel.class.php
 * 功能：      数据模型层 -- 连接数据库类 -- 单例模式
 * 版本：      1.0
 * 日期：     2016-06-08 
 * 作者：     JoeXiong
 * 版权：     Copyright © 2016 github.com/JoeXiong All Rights Reserved
 */
class datamodel
{

    private static $langdb = null; // 连接数据库对象

    /**
     * 构造函数
     * 
     * @param unknown $params            
     */
    private function __construct($db_config = array())
    {
        self::$langdb = new DBMysql($db_config);
    }

    /**
     * 获取单例对象
     * @param unknown $db_config
     */
    public static function getInstance($db_config)
    {
        if (! (self::$langdb instanceof DBMysql)) {
            new self($db_config);
        }
        return self::$langdb;
    }

    private function __clone()
    {}
    
    
}
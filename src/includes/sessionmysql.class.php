<?php

/*******************************************
 * 文件名： sessionmysql.class.php
 * 功能：     session保存数据库处理类
 * 版本：      1.0
 * 日期：     2016-06-08
 * 作者：      JoeXiong
 * 版权：      Copyright@2016 github.com/JoeXiong Inc All Rights Reserved
 *********************************************/
class session
{

    private $_lifetime;
    private $_db;
    private $_table;
    private $_userid;
    private $_domain = _COOKIE_DOMAIN_; // Cookie 作用域

    /**
     * 初始化
     *
     * @param unknown $etdbhandler            
     * @param number $lifetime            
     * @param number $userid            
     */
    function __construct($etdbhandler, $lifetime = 1440, $userid = 0)
    {
        $this->_table = _DB_PRE_ . 'sessions';
        $domain = $this->_domain;
        ini_set('session.cookie_domain', "$domain"); // session 跨域
        $this->_db = $etdbhandler;
        $this->_lifetime = $lifetime;
        $this->_userid = $userid;
        @ini_set('session.save_handler', 'user'); // 改变session处理机制为用户自定义
        $flag = session_set_save_handler(
            array(&$this,'open'), 
            array(&$this,'close'), 
            array(&$this,'read'), 
            array(&$this,'write'), 
            array(&$this,'destroy'), 
            array(&$this,'gc')
        );
        if (! session_id()) {
            session_start();
        }
    }

    function open($save_path, $session_name)
    {
        return true;
    }

    function close()
    {
        return true;
    }

    function read($id)
    {
        $sql = "SELECT SessionData FROM $this->_table WHERE SessionId=:id";
        $array = array(
            ':id' => $id
        );
        $result = $this->_db->queryOne($sql, $array);
    }

    function write($id, $data)
    {
        $ip = addslashes(funcPunlic::getIp());
        $data = addslashes($data);
        if (strlen($data) > 500)
            $data = '';
        $times = time();
        $etimes = $times + $this->_lifetime;
        
        // $data中的键为数据库字段名，值为对应的数值
        $data = array(
            'SessionId' => "$id",
            'UserId' => $this->_userid,
            'Ip' => "$ip",
            'LastVisit' => "$times",
            'Expiration' => "$etimes",
            'SessionData' => "$data",
        );
        return $this->_db->insert($this->_table, $data);
    }

    function destroy($id)
    {
        $where = array(
            'SessionId' => "$id",
        );
        return $this->_db->delete($this->_table, $where);
    }

    function gc($maxlifetime)
    {
        $times = time();
        $where = array(
            'Expiration' => "Expiration<$times",
        );
        return $this->_db->delete($this->_table,$where);
    }
}
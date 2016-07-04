<?php

/*************************************************
 * 文件名：users.dm.class.php
 * 功能：    模型层-表：joe_users 描述：用户表
 * 版本：    1.0
 * 日期：    2016-06-07 
 * 作者：    JoeXiong
 * 版权：    Copyright © 2016-2016 quwancn.com All Rights Reserved
 */
class usersDmodel
{
    private $_userid;	//int(11) unsigned
    private $_username;	//用户名varchar(50)
    private $_password;	//密码varchar(32)
    private $_email;	//邮箱varchar(80)
    private $_mobile;	//手机号码varchar(20)
    private $_ip;	//用户注册IDvarchar(30)
    private $_status;	//帐号状态tinyint(1) unsigned
    private $_areaid;	//区域Id,10001为本区;10002为qq用户;10003为新浪微博用户smallint(5) unsigned
    private $_addtime;	//创建时间int(10) unsigned
    
    /**
     *@param int $_userid
     */
    public function setUserId($_userid){
        $this->_userid=$_userid;
    }
    /**
     *@return int
     */
    public function getUserId(){
        return $this->_userid;
    }
    
    /**
     *@param string $_username
     */
    public function setUserName($_username){
        $this->_username=$_username;
    }
    /**
     *@return string
     */
    public function getUserName(){
        return $this->_username;
    }
    
    /**
     *@param string $_password
     */
    public function setPassWord($_password){
        $this->_password=$_password;
    }
    /**
     *@return string
     */
    public function getPassWord(){
        return $this->_password;
    }
    
    /**
     *@param string $_email
     */
    public function setEmail($_email){
        $this->_email=$_email;
    }
    /**
     *@return string
     */
    public function getEmail(){
        return $this->_email;
    }
    
    /**
     *@param string $_mobile
     */
    public function setMobile($_mobile){
        $this->_mobile=$_mobile;
    }
    /**
     *@return string
     */
    public function getMobile(){
        return $this->_mobile;
    }
    
    /**
     *@param string $_ip
     */
    public function setIP($_ip){
        $this->_ip=$_ip;
    }
    /**
     *@return string
     */
    public function getIP(){
        return $this->_ip;
    }
    
    /**
     *@param int $_status
     */
    public function setStatus($_status){
        $this->_status=$_status;
    }
    /**
     *@return int
     */
    public function getStatus(){
        return $this->_status;
    }
    
    /**
     *@param int $_areaid
     */
    public function setAreaId($_areaid){
        $this->_areaid=$_areaid;
    }
    /**
     *@return int
     */
    public function getAreaId(){
        return $this->_areaid;
    }
    
    /**
     *@param int $_addtime
     */
    public function setAddTime($_addtime){
        $this->_addtime=$_addtime;
    }
    /**
     *@return int
     */
    public function getAddTime(){
        return $this->_addtime;
    }
}
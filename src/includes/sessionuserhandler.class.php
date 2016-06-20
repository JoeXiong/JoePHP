<?php

/*******************************************
 * 文件名： /include/sessionuserhandler.class.php
 * 功能：     用户session处理类
 * 版本：      1.0
 * 日期：      2016-06-07
 * 作者：      JoeXiong
 * 版权：      Copyright@2016-2016 github.com/JoeXiong Inc All Rights Reserved
 *********************************************/
class sessionuserhandler
{

    private $_user;

    function __construct($iu = '',$isLogin=false)
    {
        if($isLogin){
            global $siteurl;
            if (isset($_SESSION['USERID'])) {
                $userid = intval($_SESSION['USERID']);
            } elseif (isset($_COOKIE['b51cc6fb16b04e557a9542a7549f991d'])) {
                $encryption = new selfencryption();
                $userid = $encryption->decrypt($_COOKIE['b51cc6fb16b04e557a9542a7549f991d'], _COOKIE_PRE_);
                $userid = intval($userid);
                $_SESSION['USERID'] = $userid;
            } else {
                header('location:' . $siteurl['reg']['url'] . '/usersreg/login?iu=' . $iu);
                exit;
            }
            if ($userid === 0) {
                header('location:' . $siteurl['reg']['url'] . '/usersreg/login?iu=' . $iu);
                exit;
            } else {
                $user = new usersDal();
                $row  = $user->usersArrayRow($userid);
                $this->_user = $user->usersDmodel($row);
            }
        }
    }
    
    //以下为返回用户相应的字段信息
    public function getUserId(){
        return $this->_user->getUserId();
    }
    
    public function getUserName(){
        return $this->_user->getUserName();
    }
    
    public function getPassWord(){
        return $this->_user->getPassWord();
    }
    
    public function getEmail(){
        return $this->_user->getEmail();
    }
    
    public function getType(){
        return $this->_user->getType();
    }
    
    public function getIP(){
        return $this->_user->getIP();
    }
    
    public function getAddTime(){
        return $this->_user->getAddTime();
    }
    
    public function getStatus(){
        return $this->_user->getStatus();
    }
    
    
}
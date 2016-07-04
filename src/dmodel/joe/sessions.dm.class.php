<?php
/**
* 文件名：sessions.dm.class.php
* 功能：    模型层-表-joe_sessions
* 描述：    
* 日期：    16-07-01
* 版权：    Copyright © 2016 github.com/JoeXiong All Rights Reserved
* @author JoeXiong
*/
class sessionsDmodel
{

    private $_sessionid; // varchar(32)
    private $_userid; // int(10) unsigned
    private $_ip; // varchar(100)
    private $_lastvisit; // int(10) unsigned
    private $_expiration; // int(10) unsigned
    private $_sessiondata; // varchar(500)

    public function setSessionId($_sessionid)
    {
        $this->_sessionid = $_sessionid;
    }

    public function getSessionId()
    {
        return $this->_sessionid;
    }

    public function setUserId($_userid)
    {
        $this->_userid = $_userid;
    }

    public function getUserId()
    {
        return $this->_userid;
    }

    public function setIp($_ip)
    {
        $this->_ip = $_ip;
    }

    public function getIp()
    {
        return $this->_ip;
    }

    public function setLastVisit($_lastvisit)
    {
        $this->_lastvisit = $_lastvisit;
    }

    public function getLastVisit()
    {
        return $this->_lastvisit;
    }

    public function setExpiration($_expiration)
    {
        $this->_expiration = $_expiration;
    }

    public function getExpiration()
    {
        return $this->_expiration;
    }

    public function setSessionData($_sessiondata)
    {
        $this->_sessiondata = $_sessiondata;
    }

    public function getSessionData()
    {
        return $this->_sessiondata;
    }
}
?>
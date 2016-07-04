<?php

/**
* 文件名：sessions.d.class.php
* 功能：    数据层
* 描述：    
* 日期：    16-07-01
* 版权：    Copyright © 2016 github.com/JoeXiong All Rights Reserved
* @author JoeXiong
*/
class sessionsDal extends datamodel
{

    private $_tablename;
    private $_db;

    public function __construct()
    {
        global $db_config;
        $this->_db = parent::getInstance($db_config);
        $this->_tablename = 'joe_sessions';
    }

    /**
     * 添加一行数据
     */
    public function sessionsAdd(sessionsDmodel $sessions)
    {
        try {
            if (! $sessions instanceof sessionsDmodel)
                return false;
            $data = array();
            if ($sessions->getSessionId() !== null) {
                $data['SessionId'] = $sessions->getSessionId();
            }
            if ($sessions->getUserId() !== null) {
                $data['UserId'] = $sessions->getUserId();
            }
            if ($sessions->getIp() !== null) {
                $data['Ip'] = $sessions->getIp();
            }
            if ($sessions->getLastVisit() !== null) {
                $data['LastVisit'] = $sessions->getLastVisit();
            }
            if ($sessions->getExpiration() !== null) {
                $data['Expiration'] = $sessions->getExpiration();
            }
            if ($sessions->getSessionData() !== null) {
                $data['SessionData'] = $sessions->getSessionData();
            }
            return $this->_db->insert($this->_tablename, $data);
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * 根据条件查询列表
     */
    public function sessionsList($fields = "*", $wheresql = "1=:a", $where = array(":a" =>1))
    {
        try {
            $sql = "SELECT " . $fields . " FROM $this->_tablename WHERE $wheresql";
            return $this->_db->queryAll($sql, $where);
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * 根据条件查询记录数
     */
    public function sessionsCount($wheresql = "1=?", $where = array(1))
    {
        try {
            return $this->_db->count($this->_tablename, $wheresql, $where);
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * 根据主键id查询记录数
     */
    public function sessionsArrayRow($id, $fields = "*")
    {
        try {
            $sql = "select " . $fields . " from " . $this->_tablename . " where SessionId=:SessionId";
            $where = array(
                'SessionId' => $id
            );
            return $this->_db->queryAll($sql, $where);
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * 更新一行数据
     */
    public function sessionsUpdate(sessionsDmodel $sessions)
    {
        try {
            if (! $sessions instanceof sessionsDmodel)
                return false;
            if ($sessions->getSessionId() == null && $sessions->getSessionId() == 0)
                return false;
            $data = array();
            if ($sessions->getSessionId() !== null) {
                $data['SessionId'] = $sessions->getSessionId();
            }
            if ($sessions->getUserId() !== null) {
                $data['UserId'] = $sessions->getUserId();
            }
            if ($sessions->getIp() !== null) {
                $data['Ip'] = $sessions->getIp();
            }
            if ($sessions->getLastVisit() !== null) {
                $data['LastVisit'] = $sessions->getLastVisit();
            }
            if ($sessions->getExpiration() !== null) {
                $data['Expiration'] = $sessions->getExpiration();
            }
            if ($sessions->getSessionData() !== null) {
                $data['SessionData'] = $sessions->getSessionData();
            }
            $where['SessionId'] = $sessions->getSessionId();
            return $this->_db->updata($this->_tablename, $data, $where);
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * 根据where条件更新数据
     */
    public function sessionsWhereUpdate(sessionsDmodel $sessions, $where = array("1"=>2))
    {
        try {
            if (! $sessions instanceof sessionsDmodel)
                return false;
            $data = array();
            if ($sessions->getSessionId() !== null) {
                $data['SessionId'] = $sessions->getSessionId();
            }
            if ($sessions->getUserId() !== null) {
                $data['UserId'] = $sessions->getUserId();
            }
            if ($sessions->getIp() !== null) {
                $data['Ip'] = $sessions->getIp();
            }
            if ($sessions->getLastVisit() !== null) {
                $data['LastVisit'] = $sessions->getLastVisit();
            }
            if ($sessions->getExpiration() !== null) {
                $data['Expiration'] = $sessions->getExpiration();
            }
            if ($sessions->getSessionData() !== null) {
                $data['SessionData'] = $sessions->getSessionData();
            }
            return $this->_db->updata($this->_tablename, $data, $where);
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * 删除一行数据
     */
    public function sessionsDelete($id)
    {
        try {
            return $this->_db->delete($this->_tablename, array(
                'SessionId' => $id
            ));
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * 根据where删除数据
     */
    public function sessionsWhereDelete($where)
    {
        try {
            return $this->_db->delete($this->_tablename, $where);
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * 根据一行数据返回Dmodel对象
     */
    public function sessionsDmodel(array $row)
    {
        $sessions = new sessionsDmodel();
        if (! empty($row)) {
            isset($row["SessionId"]) ? $sessions->setSessionId($row["SessionId"]) : "";
            isset($row["UserId"]) ? $sessions->setUserId($row["UserId"]) : "";
            isset($row["Ip"]) ? $sessions->setIp($row["Ip"]) : "";
            isset($row["LastVisit"]) ? $sessions->setLastVisit($row["LastVisit"]) : "";
            isset($row["Expiration"]) ? $sessions->setExpiration($row["Expiration"]) : "";
            isset($row["SessionData"]) ? $sessions->setSessionData($row["SessionData"]) : "";
        }
        return $sessions;
    }
}
?>
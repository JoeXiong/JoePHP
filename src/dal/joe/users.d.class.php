 <?php

/*************************************************
 * 文件名：users.d.class.php
 * 功能：    数据层
 * 版本：    1.0
 * 日期：    2016-06-07
 * 作者：    JoeXiong
 * 版权：   Copyright@2016-2016 github.com/JoeXiong Inc All Rights Reserved
 */
class usersDal extends datamodel
{

    private $_tablename; // 操作表名
    private $_db;

    public function __construct()
    {
        global $db_config;
        $this->_db = parent::getInstance($db_config);
        $this->_tablename = 'joe_users';
    }

    /**
     * 添加一行数据
     *
     * @param usersDmodel $users            
     */
    public function usersAdd(usersDmodel $users)
    {
        try {
            if (! $users instanceof usersDmodel)
                return false;
            $data = array();
            if ($users->getUserName() !== null) {
                $data['UserName'] = $users->getUserName();
            }
            if ($users->getPassWord() !== null) {
                $data['PassWord'] = $users->getPassWord();
            }
            if ($users->getEmail() !== null) {
                $data['Email'] = $users->getEmail();
            }
            if ($users->getMobile() !== null) {
                $data['Mobile'] = $users->getMobile();
            }
            if ($users->getIP() !== null) {
                $data['IP'] = $users->getIP();
            }
            if ($users->getStatus() !== null) {
                $data['Status'] = $users->getStatus();
            }
            if ($users->getAreaId() !== null) {
                $data['AreaId'] = $users->getAreaId();
            }
            if ($users->getAddTime() !== null) {
                $data['AddTime'] = $users->getAddTime();
            }
            return $this->_db->insert($this->_tablename, $data);
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * 根据条件查询列表
     *
     * @param string $fields            
     * @param string $wheresql            
     * @param unknown $where            
     */
    public function usersList($fields = "*", $wheresql = "1=:a", $where = array(':a'=>1))
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
     *
     * @param string $wheresql            
     * @param unknown $where            
     */
    public function usersCount($wheresql = "1=:a", $where = array(':a'=>1))
    {
        try {
            return $this->_db->count($this->_tablename, $wheresql, $where);
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * 根据 $userid 获取一行数据
     *
     * @param
     *            int userid
     * @param string $fields            
     */
    public function usersArrayRow($userid, $fields = "*")
    {
        try {
            $sql = "select " . $fields . " from " . $this->_tablename . " where UserId=:UserId";
            $where = array(
                'UserId' => $userid
            );
            return $this->_db->queryAll($sql, $where);
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * 更新一行数据
     *
     * @param usersDmodel $users            
     */
    public function usersUpdate(usersDmodel $users)
    {
        try {
            if (! $users instanceof usersDmodel)
                return false;
            if ($users->getUserId() == null && $users->getUserId() == 0)
                return false;
            $data = array();
            if ($users->getUserName() !== null) {
                $data['UserName'] = $users->getUserName();
            }
            if ($users->getPassWord() !== null) {
                $data['PassWord'] = $users->getPassWord();
            }
            if ($users->getEmail() !== null) {
                $data['Email'] = $users->getEmail();
            }
            if ($users->getMobile() !== null) {
                $data['Mobile'] = $users->getMobile();
            }
            if ($users->getIP() !== null) {
                $data['IP'] = $users->getIP();
            }
            if ($users->getStatus() !== null) {
                $data['Status'] = $users->getStatus();
            }
            if ($users->getAreaId() !== null) {
                $data['AreaId'] = $users->getAreaId();
            }
            if ($users->getAddTime() !== null) {
                $data['AddTime'] = $users->getAddTime();
            }
            $where['UserId'] = $users->getUserId();
            return $this->_db->updata($this->_tablename, $data, $where);
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * 根据where条件更新数据
     *
     * @param usersDmodel $users            
     * @param unknown $where            
     */
    public function usersWhereUpdate(usersDmodel $users, $where = array('1' => 2))
    {
        try {
            if (! $users instanceof usersDmodel)
                return false;
            $data = array();
            if ($users->getUserId() !== null) {
                $data['UserId'] = $users->getUserId();
            }
            if ($users->getUserName() !== null) {
                $data['UserName'] = $users->getUserName();
            }
            if ($users->getPassWord() !== null) {
                $data['PassWord'] = $users->getPassWord();
            }
            if ($users->getEmail() !== null) {
                $data['Email'] = $users->getEmail();
            }
            if ($users->getMobile() !== null) {
                $data['Mobile'] = $users->getMobile();
            }
            if ($users->getIP() !== null) {
                $data['IP'] = $users->getIP();
            }
            if ($users->getStatus() !== null) {
                $data['Status'] = $users->getStatus();
            }
            if ($users->getAreaId() !== null) {
                $data['AreaId'] = $users->getAreaId();
            }
            if ($users->getAddTime() !== null) {
                $data['AddTime'] = $users->getAddTime();
            }
            return $this->_db->updata($this->_tablename, $data, $where);
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * 删除一行数据
     *
     * @param unknown $userid            
     */
    public function usersDelete($userid)
    {
        try {
            return $this->_db->delete($this->_tablename, array(
                'UserId' => $userid
            ));
        } catch (Exception $e) {
            throw $e;
        }
    }
    
    /**
     * 根据where删除数据
     *
     * @param unknown $userid
     */
    public function usersWhereDelete($where)
    {
        try {
            return $this->_db->delete($this->_tablename, $where);
        } catch (Exception $e) {
            throw $e;
        }
    }
    
    /**
     * @description	 根据一行数据返回usersDmodel对象
     *
     * @param array $usersrow
     * @return	usersDmodel
     */
    public function usersDmodel(array $usersrow){
        $users=new usersDmodel();
        if(!empty($usersrow)){
            isset($usersrow["UserId"])?$users->setUserId($usersrow["UserId"]):"";
            isset($usersrow["UserName"])?$users->setUserName($usersrow["UserName"]):"";
            isset($usersrow["PassWord"])?$users->setPassWord($usersrow["PassWord"]):"";
            isset($usersrow["Email"])?$users->setEmail($usersrow["Email"]):"";
            isset($usersrow["Mobile"])?$users->setMobile($usersrow["Mobile"]):"";
            isset($usersrow["IP"])?$users->setIP($usersrow["IP"]):"";
            isset($usersrow["Status"])?$users->setStatus($usersrow["Status"]):"";
            isset($usersrow["AreaId"])?$users->setAreaId($usersrow["AreaId"]):"";
            isset($usersrow["AddTime"])?$users->setAddTime($usersrow["AddTime"]):"";
        }
        return $users;
    }
}
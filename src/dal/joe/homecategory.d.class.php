<?php

/*************************************************
 * 文件名：homecategory.d.class.php
 * 功能：    数据层
 * 版本：    1.0
 * 日期：   2016-06-20
 * 作者：    JoeXiong
 * 版权：   Copyright@2016-2016 github.com/JoeXiong Inc All Rights Reserved
 */
class homecategoryDal extends datamodel
{

    private $_tablename; // 操作表名

    private $_db;

    public function __construct()
    {
        global $db_config;
        $this->_db = parent::getInstance($db_config);
        $this->_tablename = 'joe_homecategory';
    }

    /**
     * 添加一行数据
     *
     * @param homecategoryDmodel $homecategory            
     * @throws Exception
     */
    public function homecategoryAdd(homecategoryDmodel $homecategory)
    {
        try {
            if (! $homecategory instanceof homecategoryDmodel)
                return false;
            $data = array();
            if ($homecategory->getName() !== null) {
                $data['Name'] = $homecategory->getName();
            }
            if ($homecategory->getType() !== null) {
                $data['Type'] = $homecategory->getType();
            }
            if ($homecategory->getLinkUrl() !== null) {
                $data['LinkUrl'] = $homecategory->getLinkUrl();
            }
            if ($homecategory->getLinkpicPath() !== null) {
                $data['LinkpicPath'] = $homecategory->getLinkpicPath();
            }
            if ($homecategory->getImageTime() !== null) {
                $data['ImageTime'] = $homecategory->getImageTime();
            }
            if ($homecategory->getDomainKey() !== null) {
                $data['DomainKey'] = $homecategory->getDomainKey();
            }
            if ($homecategory->getLinkPoint() !== null) {
                $data['LinkPoint'] = $homecategory->getLinkPoint();
            }
            if ($homecategory->getParentId() !== null) {
                $data['ParentId'] = $homecategory->getParentId();
            }
            if ($homecategory->getDepth() !== null) {
                $data['Depth'] = $homecategory->getDepth();
            }
            if ($homecategory->getOrderNum() !== null) {
                $data['OrderNum'] = $homecategory->getOrderNum();
            }
            if ($homecategory->getCategoryType() !== null) {
                $data['CategoryType'] = $homecategory->getCategoryType();
            }
            if ($homecategory->getAddTime() !== null) {
                $data['AddTime'] = $homecategory->getAddTime();
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
    public function homecategoryList($fields = "*", $wheresql = "1=:a", $where = array(':a'=>1))
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
    public function homecategoryCount($wheresql = "1=:a", $where = array(':a'=>1))
    {
        try {
            return $this->_db->count($this->_tablename, $wheresql, $where);
        } catch (Exception $e) {
            throw $e;
        }
    }
    
    /**
     * 根据ID获取一行数据
     * @param unknown $id
     * @param string $fields
     */
    public function homecategoryArrayRow($id, $fields="*")
    {
        try {
            $sql = "select " . $fields . " from " . $this->_tablename . " where UserId=:UserId";
            $where = array(
                'Id' => $id
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
    public function homecategoryUpdate(homecategoryDmodel $homecategory)
    {
        try {
            if (! $homecategory instanceof homecategoryDmodel)
                return false;
            if($homecategory->getId() == null && $homecategory->getId() == 0)
                return false;
            $data = array();
            if ($homecategory->getName() !== null) {
                $data['Name'] = $homecategory->getName();
            }
            if ($homecategory->getType() !== null) {
                $data['Type'] = $homecategory->getType();
            }
            if ($homecategory->getLinkUrl() !== null) {
                $data['LinkUrl'] = $homecategory->getLinkUrl();
            }
            if ($homecategory->getLinkpicPath() !== null) {
                $data['LinkpicPath'] = $homecategory->getLinkpicPath();
            }
            if ($homecategory->getImageTime() !== null) {
                $data['ImageTime'] = $homecategory->getImageTime();
            }
            if ($homecategory->getDomainKey() !== null) {
                $data['DomainKey'] = $homecategory->getDomainKey();
            }
            if ($homecategory->getLinkPoint() !== null) {
                $data['LinkPoint'] = $homecategory->getLinkPoint();
            }
            if ($homecategory->getParentId() !== null) {
                $data['ParentId'] = $homecategory->getParentId();
            }
            if ($homecategory->getDepth() !== null) {
                $data['Depth'] = $homecategory->getDepth();
            }
            if ($homecategory->getOrderNum() !== null) {
                $data['OrderNum'] = $homecategory->getOrderNum();
            }
            if ($homecategory->getCategoryType() !== null) {
                $data['CategoryType'] = $homecategory->getCategoryType();
            }
            if ($homecategory->getAddTime() !== null) {
                $data['AddTime'] = $homecategory->getAddTime();
            }
            $where['Id'] = $homecategory->getId();
            return $this->_db->updata($this->_tablename, $data, $where);
        } catch (Exception $e) {
            throw $e;
        }
    }
    
    /**
     * 更新一行数据
     *
     * @param usersDmodel $users
     */
    public function homecategoryWhereUpdate(homecategoryDmodel $homecategory,$where = array())
    {
        try {
            if (! $homecategory instanceof homecategoryDmodel)
                return false;
            $data = array();
            if($homecategory->getId() !== null){
                $data['Id'] = $homecategory->getId();
            }
            if ($homecategory->getName() !== null) {
                $data['Name'] = $homecategory->getName();
            }
            if ($homecategory->getType() !== null) {
                $data['Type'] = $homecategory->getType();
            }
            if ($homecategory->getLinkUrl() !== null) {
                $data['LinkUrl'] = $homecategory->getLinkUrl();
            }
            if ($homecategory->getLinkpicPath() !== null) {
                $data['LinkpicPath'] = $homecategory->getLinkpicPath();
            }
            if ($homecategory->getImageTime() !== null) {
                $data['ImageTime'] = $homecategory->getImageTime();
            }
            if ($homecategory->getDomainKey() !== null) {
                $data['DomainKey'] = $homecategory->getDomainKey();
            }
            if ($homecategory->getLinkPoint() !== null) {
                $data['LinkPoint'] = $homecategory->getLinkPoint();
            }
            if ($homecategory->getParentId() !== null) {
                $data['ParentId'] = $homecategory->getParentId();
            }
            if ($homecategory->getDepth() !== null) {
                $data['Depth'] = $homecategory->getDepth();
            }
            if ($homecategory->getOrderNum() !== null) {
                $data['OrderNum'] = $homecategory->getOrderNum();
            }
            if ($homecategory->getCategoryType() !== null) {
                $data['CategoryType'] = $homecategory->getCategoryType();
            }
            if ($homecategory->getAddTime() !== null) {
                $data['AddTime'] = $homecategory->getAddTime();
            }
            $where['Id'] = $homecategory->getId();
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
    public function homecategoryDelete($id)
    {
        try {
            return $this->_db->delete($this->_tablename, array(
                'Id' => $id
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
    public function homecategoryWhereDelete($where)
    {
        try {
            return $this->_db->delete($this->_tablename, $where);
        } catch (Exception $e) {
            throw $e;
        }
    }
    
    /**
	 * @description	 根据一行数据返回homecategoryDmodel对象 
	 *
	 * @param array $homecategoryrow
	 * @return	homecategoryDmodel 
	 */
	public function homecategoryDmodel(array $homecategoryrow){
		$homecategory=new homecategoryDmodel();
		 if(!empty($homecategoryrow)){
			 isset($homecategoryrow["Id"])?$homecategory->setId($homecategoryrow["Id"]):"";
			 isset($homecategoryrow["Name"])?$homecategory->setName($homecategoryrow["Name"]):"";
			 isset($homecategoryrow["Type"])?$homecategory->setType($homecategoryrow["Type"]):"";
			 isset($homecategoryrow["LinkUrl"])?$homecategory->setLinkUrl($homecategoryrow["LinkUrl"]):"";
			 isset($homecategoryrow["LinkpicPath"])?$homecategory->setLinkpicPath($homecategoryrow["LinkpicPath"]):"";
			 isset($homecategoryrow["ImageTime"])?$homecategory->setImageTime($homecategoryrow["ImageTime"]):"";
			 isset($homecategoryrow["DomainKey"])?$homecategory->setDomainKey($homecategoryrow["DomainKey"]):"";
			 isset($homecategoryrow["LinkPoint"])?$homecategory->setLinkPoint($homecategoryrow["LinkPoint"]):"";
			 isset($homecategoryrow["ParentId"])?$homecategory->setParentId($homecategoryrow["ParentId"]):"";
			 isset($homecategoryrow["Depth"])?$homecategory->setDepth($homecategoryrow["Depth"]):"";
			 isset($homecategoryrow["OrderNum"])?$homecategory->setOrderNum($homecategoryrow["OrderNum"]):"";
			 isset($homecategoryrow["CategoryType"])?$homecategory->setCategoryType($homecategoryrow["CategoryType"]):"";
			 isset($homecategoryrow["AddTime"])?$homecategory->setAddTime($homecategoryrow["AddTime"]):"";
		 }
		 return $homecategory;
	}
}
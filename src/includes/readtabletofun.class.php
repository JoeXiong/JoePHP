<?php

/*******************************************
 * 文件名： /include/readtabletofun.class.php
 * 功能：     读取数据库中表结构生成对象类和操作类
 * 版本：      1.0
 * 日期：      2016-06-28 14:16:22
 * 作者：     JoeXiong
 * 版权：      Copyright@2016-2016 github.com/JoeXiong All Rights Reserved
 *********************************************/
class readtable
{

    /**
     * 生成文件
     * 
     * @param unknown $classStr
     *            类字符串
     * @param unknown $fileName
     *            保存的类名
     * @param unknown $spath
     *            保存的路径
     * @return number
     */
    public function writeFile($classStr, $fileName, $spath)
    {
        if (file_exists($spath . $fileName)) {
            return 3;
            exit();
        }
        $file = fopen($spath . $fileName, "w+");
        fwrite($file, $classStr);
        fclose($file);
        if (file_exists($spath . $fileName)) {
            return 0;
        } else {
            return 1;
        }
    }

    /**
     *
     * 读取表结构生成表操作 类
     * 
     * @param unknown $res
     *            查询数据库当前表信息
     * @param unknown $className
     *            生成类名
     * @param unknown $tablePre
     *            表前缀
     * @param unknown $tableName
     *            表名
     * @param string $annStr
     *            类注释
     */
    public function readDmodelToDal($res, $className, $tablePre, $tableName, $annStr = '')
    {
        // class start
        $result = '<?php ' . "\n";
        $result .= $annStr;
        $result .= "\n" . 'class ' . $className . ' extends datamodel' . "\n";
        $result .= "\n{";
        
        // 变量
        $result .= "\n" . 'private $_tablename;';
        $result .= "\n" . 'private $_db;';
        
        // 构造函数
        $result .= "\n" . 'public function __construct()';
        $result .= "\n{";
        $result .= "\n" . 'global $db_config;'; // 数据库连接参数
        $result .= "\n" . '$this->_db=parent::getInstance($db_config);';
        $result .= "\n" . '$this->_tablename = \'' . $tablePre . $tableName . '\';';
        $result .= "\n}";
        
        // 获得表的主键id字段
        $kFields = $this->tablePri($res);
        
        // 添加一行数据操作方法
        $result .= $this->addMethodAnnotation('添加一行数据');
        $result .= "\n" . 'public function ' . $tableName . 'Add(' . $tableName . 'Dmodel $' . $tableName . ')';
        $result .= "\n{";
        $result .= "\ntry{";
        $result .= "\n" . 'if(! $' . $tableName . ' instanceof ' . $tableName . 'Dmodel)return false;';
        $result .= "\n" . '$data = array();';
        foreach ($res as $v) {
            $result .= "\n" . 'if($' . $tableName . '->get' . $v['Field'] . '() !== null){';
            $result .= '$data[\'' . $v['Field'] . '\']=$' . $tableName . '->get' . $v['Field'] . '();}';
        }
        $result .= "\n" . 'return $this->_db->insert($this->_tablename, $data);';
        $result .= "\n" . '}catch (Exception $e) {';
        $result .= 'throw $e;';
        $result .= "\n}";
        $result .= "\n}";
        
        // 根据条件查询列表操作方法
        $result .= $this->addMethodAnnotation('根据条件查询列表');
        $result .= "\n" . 'public function ' . $tableName . 'List($fields="*",$wheresql="1=:a",$where=array(":a" =>1))';
        $result .= "\n{";
        $result .= "\ntry{";
        $result .= "\n" . '$sql = "SELECT " . $fields . " FROM $this->_tablename WHERE $wheresql";';
        $result .= "\n" . 'return $this->_db->queryAll($sql, $where);';
        $result .= "\n" . '}catch (Exception $e) {';
        $result .= 'throw $e;';
        $result .= "\n}";
        $result .= "\n}";
        
        // 根据条件查询记录数操作方法
        $result .= $this->addMethodAnnotation('根据条件查询记录数');
        $result .= "\n" . 'public function ' . $tableName . 'Count($wheresql = "1=?", $where = array(1))';
        $result .= "\n{";
        $result .= "\ntry{";
        $result .= "\n" . 'return $this->_db->count($this->_tablename, $wheresql, $where);';
        $result .= "\n" . '}catch (Exception $e) {';
        $result .= 'throw $e;';
        $result .= "\n}";
        $result .= "\n}";
        
        // 根据主键id查询记录数操作方法
        $result .= $this->addMethodAnnotation('根据主键id查询记录数');
        $result .= "\n" . 'public function ' . $tableName . 'ArrayRow($id, $fields = "*")';
        $result .= "\n{";
        $result .= "\ntry{";
        $result .= "\n" . '$sql = "select " . $fields . " from " . $this->_tablename . " where ' . $kFields . '=:' . $kFields . '";';
        $result .= "\n" . '$where=array(\'' . $kFields . '\'=>$id);';
        $result .= "\n" . 'return $this->_db->queryAll($sql, $where);';
        $result .= "\n" . '}catch (Exception $e) {';
        $result .= 'throw $e;';
        $result .= "\n}";
        $result .= "\n}";
        
        // 更新一行数据操作方法
        $result .= $this->addMethodAnnotation('更新一行数据');
        $result .= "\n" . 'public function ' . $tableName . 'Update(' . $tableName . 'Dmodel $' . $tableName . ')';
        $result .= "\n{";
        $result .= "\ntry{";
        $result .= "\n" . 'if(! $' . $tableName . ' instanceof ' . $tableName . 'Dmodel)return false;';
        $result .= "\n" . 'if($' . $tableName . '->get' . $kFields . '()==null&&$' . $tableName . '->get' . $kFields . '()==0)return false;';
        $result .= "\n" . '$data = array();';
        foreach ($res as $v) {
            $result .= "\n" . 'if($' . $tableName . '->get' . $v['Field'] . '() !== null){';
            $result .= '$data[\'' . $v['Field'] . '\']=$' . $tableName . '->get' . $v['Field'] . '();}';
        }
        $result .= "\n" . '$where[\'' . $kFields . '\'] = $' . $tableName . '->get' . $kFields . '();';
        $result .= "\n" . 'return $this->_db->updata($this->_tablename, $data, $where);';
        $result .= "\n" . '}catch (Exception $e) {';
        $result .= 'throw $e;';
        $result .= "\n}";
        $result .= "\n}";
        
        // 根据where条件更新数据操作方法
        $result .= $this->addMethodAnnotation('根据where条件更新数据');
        $result .= "\n" . 'public function ' . $tableName . 'WhereUpdate(' . $tableName . 'Dmodel $' . $tableName . ',$where=array("1"=>2))';
        $result .= "\n{";
        $result .= "\ntry{";
        $result .= "\n" . 'if(! $' . $tableName . ' instanceof ' . $tableName . 'Dmodel)return false;';
        $result .= "\n" . '$data = array();';
        foreach ($res as $v) {
            $result .= "\n" . 'if($' . $tableName . '->get' . $v['Field'] . '() !== null){';
            $result .= '$data[\'' . $v['Field'] . '\']=$' . $tableName . '->get' . $v['Field'] . '();}';
        }
        $result .= "\n" . 'return $this->_db->updata($this->_tablename, $data, $where);';
        $result .= "\n" . '}catch (Exception $e) {';
        $result .= 'throw $e;';
        $result .= "\n}";
        $result .= "\n}";
        
        // 删除一行数据操作方法
        $result .= $this->addMethodAnnotation('删除一行数据');
        $result .= "\n" . 'public function ' . $tableName . 'Delete($id)';
        $result .= "\n{";
        $result .= "\ntry{";
        $result .= "\n" . ' return $this->_db->delete($this->_tablename, array(\'' . $kFields . '\' => $id));';
        $result .= "\n" . '}catch (Exception $e) {';
        $result .= 'throw $e;';
        $result .= "\n}";
        $result .= "\n}";
        
        // 根据where删除数据操作方法
        $result .= $this->addMethodAnnotation('根据where删除数据');
        $result .= "\n" . 'public function ' . $tableName . 'WhereDelete($where)';
        $result .= "\n{";
        $result .= "\ntry{";
        $result .= "\n" . ' return $this->_db->delete($this->_tablename, $where);';
        $result .= "\n" . '}catch (Exception $e) {';
        $result .= 'throw $e;';
        $result .= "\n}";
        $result .= "\n}";
        
        // 根据一行数据返回Dmodel对象操作方法
        $result .= $this->addMethodAnnotation('根据一行数据返回Dmodel对象');
        $result .= "\n" . 'public function ' . $tableName . 'Dmodel(array $row)';
        $result .= "\n{";
        $result .= "\n" . '$' . $tableName . '=new ' . $tableName . 'Dmodel();';
        $result .= "\n" . 'if(!empty($row))';
        $result .= "\n{";
        foreach ($res as $v) {
            $result .= "\n" . 'isset($row["' . $v['Field'] . '"])?$' . $tableName . '->set' . $v['Field'] . '($row["' . $v['Field'] . '"]):"";';
        }
        $result .= "\n}";
        $result .= "\n" . 'return $' . $tableName . ';';
        $result .= "\n}";
        
        // class end
        $result .= "\n}";
        $result .= " \n ?>";
        
        return $result;
    }

    /**
     * 根据表结构初始化表对象
     *
     * @param unknown $res            
     * @param unknown $className            
     * @return string
     */
    public function readTableStr($res, $className, $annStr = '')
    {
        $result = '<?php ' . "\n";
        $result .= $annStr;
        $result .= "class $className \n{";
        
        // 变量
        foreach ($res as $v) {
            $result .= "\n" . 'private $_' . strtolower($v['Field']) . ";//" . $v['Comment'] . $v['Type'];
        }
        
        $result .= "\n";
        
        // get set
        foreach ($res as $v) {
            $result .= "\n public function set" . $v['Field'] . '($_' . strtolower($v['Field']) . "){";
            $result .= "\n" . ' $this->_' . strtolower($v['Field']) . '=$_' . strtolower($v['Field']) . ";";
            $result .= "\n }";
            
            $result .= "\n public function get" . $v['Field'] . '(){';
            $result .= "\n" . ' return $this->_' . strtolower($v['Field']) . ";";
            $result .= "\n }";
            
            $result .= "\n";
        }
        
        $result .= " \n }";
        $result .= " \n ?>";
        
        return $result;
    }

    /**
     * 连接数据库,查询表结构
     * 
     * @param unknown $array
     *            数据库连接参数
     * @param unknown $tableName
     *            表名
     */
    public function linkdb($array, $tableName)
    {
        $mysql_server_name = $array['host'];
        $mysql_username = $array['username'];
        $mysql_password = $array['password'];
        $mysql_database = $array['dbname'];
        $conn = mysql_connect($mysql_server_name, $mysql_username, $mysql_password) or die("error connecting"); // 连接数据库
        mysql_query("set names " . $array['charset']);
        mysql_select_db($mysql_database);
        
        $sql = "SHOW FULL COLUMNS FROM $tableName";
        $res = mysql_query($sql);
        $res = $this->dataTable($res);
        
        return $res;
    }

    /**
     * 添加类注释
     *
     * @param unknown $fileName            
     * @param unknown $fun            
     * @param unknown $des            
     * @param unknown $date            
     * @param unknown $author            
     */
    public function addAnnotation($fileName, $fun, $des = '', $f = false)
    {
        $annStr = "\n/**";
        $annStr .= "\n* 文件名：" . $fileName;
        if ($f) {
            $annStr .= "\n* 功能：    数据层";
        } else {
            $annStr .= "\n* 功能：    模型层-表-" . $fun;
        }
        $annStr .= "\n* 描述：    " . $des;
        $annStr .= "\n* 日期：    " . date('y-m-d', time());
        $annStr .= "\n* 版权：    Copyright © 2016 github.com/JoeXiong All Rights Reserved";
        $annStr .= "\n* @author JoeXiong";
        $annStr .= "\n*/";
        return $annStr;
    }

    /**
     * 添加方法注释
     *
     * @param unknown $des            
     */
    private function addMethodAnnotation($des, $param = array())
    {
        $annStr = "\n/**";
        $annStr .= "\n* " . $des;
        $annStr .= "\n*/";
        return $annStr;
    }

    /**
     * 返回表集合
     * 
     * @param unknown $query            
     * @return multitype:|number
     */
    private function dataTable($query)
    {
        if ($query) {
            $ListTable = array();
            while ($rows = mysql_fetch_array($query, MYSQL_ASSOC)) {
                array_push($ListTable, $rows);
            }
            return $ListTable;
        } else {
            return 0;
        }
    }

    /**
     * 获得表结构的主键
     *
     * @param unknown $res            
     */
    private function tablePri($res)
    {
        foreach ($res as $v) {
            if ($v['Key'] == 'PRI')
                return $v['Field'];
            exit();
        }
    }
}
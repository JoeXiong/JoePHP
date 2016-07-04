<?php

/*******************************************
 * 文件名： /action/readtabletofun.a.class.php
 * 功能：     生成数据表的操作类和表映射类
 * 版本：      1.0
 * 日期：    2016-06-16 16:46:29
 * 作者：     JoeXiong
 * 版权：      Copyright@2016-2016 github.com/JoeXiong All Rights Reserved
 *********************************************/
class readtabletofunDo extends actionDo
{

    public function __construct()
    {
        parent::smarty();
    }

    public function index()
    {
        // 获取数据库所有表
        global $db_config;
        $langdb = datamodel::getInstance($db_config);
        $sql = "SHOW TABLES";
        $result = $langdb->queryAll($sql);
        
        $this->smarty->assign('table', $result);
        $this->smarty->display('readtabletofun/index.html');
    }

    /**
     * 生成操作类或表映射类 Ajax
     * 
     * 0: 生成成功   1:生成有误    2:传递参数有误  3:已经生成
     */
    public function createAjax()
    {
        $falg = isset($_POST['falg']) ? $_POST['falg'] : null;
        $tableName = isset($_POST['name']) ? $_POST['name'] : '';
        
        if($falg === null || $tableName === ''){
            echo 2;
            exit;
        }
        
        global $db_config;
        $fun = new readtable();
        $tableArray = split('_', $tableName);
        
        if($falg === '1'){
            $fileName = $tableArray[1] . '.d.class.php';
            $className = $tableArray[1] . 'Dal';
            $res = $fun->linkdb($db_config, $tableName);
            $annStr = $fun->addAnnotation($fileName, $tableName, '', true);
            $classStr = $fun->readDmodelToDal($res, $className, $tableArray[0].'_', $tableArray[1], $annStr);
            echo $fun->writeFile($classStr, $fileName, _SITE_ROOT_ . '/dal/joe/');
        }else{
            $fileName = $tableArray[1] . '.dm.class.php';
            $className = $tableArray[1] . 'Dmodel';
            $res = $fun->linkdb($db_config, $tableName);
            $annStr = $fun->addAnnotation($fileName, $tableName);
            $classStr = $fun->readTableStr($res, $className, $annStr);
            echo $fun->writeFile($classStr, $fileName, _SITE_ROOT_ . '/dmodel/joe/');
        }
        
    }
}
?>
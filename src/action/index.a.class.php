<?php
/*******************************************
 * 文件名： /action/init.php
 * 功能：     站点默认action 首页
 * 版本：      1.0
 * 日期：    2016-06-16 16:46:29
 * 作者：     JoeXiong
 * 版权：      Copyright@2016-2016 github.com/JoeXiong All Rights Reserved
 *********************************************/
class indexDo extends actionDo {
    
    public function __construct(){
        parent::smarty();
    }
    
    
    public function index(){
       $this->smarty->display('new/index.html');
    }
}
?>
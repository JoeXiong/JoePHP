<?php

/*******************************************
 * 文件名： /include/init.php
 * 功能：     action 基础类
 * 版本：      1.0
 * 日期：    2016-06-16 16:46:29
 * 作者：     JoeXiong
 * 版权：      Copyright@2016-2016 github.com/JoeXiong All Rights Reserved
 *********************************************/
class actionDo
{

    protected $smarty;
    // 用户信息数组
    protected $userRow = array();

    /**
     * 初始化Smarty
     *
     * @param string $templatesfile            
     */
    protected final function smarty($templatesfile = '')
    {
        if (! $this->smarty instanceof Smarty) {
            $this->smarty = new Smarty();
            $this->smarty->compile_check   = true;
            // 模版目录
            $this->smarty->template_dir    = _TEMPLATES_DIR_ . (empty($templatesfile) ? '' : $templatesfile);
            // 缓存目录
            $this->smarty->cache_dir       = _TEMP_DIR_ . 'cache';
            // 编译目录  
            $this->smarty->compile_dir     = _TEMP_DIR_ . 'templates_c';
            // 是否开启缓存
            $this->smarty->caching         = FALSE;
            // 是否生成子目录
            $this->smarty->use_sub_dirs    = FALSE;
            $this->smarty->left_delimiter  = '<{';
            $this->smarty->right_delimiter = '}>';
            
            global $siteurl;
            $this->smarty->assign('siteurl',$siteurl);
            
            return $this->smarty;            
        }
    }
}
<?php

/*******************************************
 * 文件名： /include/init.php
 * 功能：     初始文件
 * 版本：      1.0
 * 日期：     2016-06-06 15:29:02
 * 作者：     JoeXiong
 * 版权：      Copyright@2016-2016 github.com/JoeXiong All Rights Reserved
 *********************************************/
class init
{
    private $test; 
    /**
     * 执行入口
     */
    public static function run()
    {
        date_default_timezone_set("Asia/Shanghai");
        spl_autoload_register(array(
            'init',
            'user_autoload'
        ));
        
        self::initPath();
        self::initRequest();
        self::loadConfig();
        self::loadPublic();
        self::loadSession();
        self::loadUserHandlerSession();
        self::dispatch();
    }
    
    /**
     * 初始化路径常量
     */
    private static function initPath()
    {
        // 反斜杠
        define('DS', DIRECTORY_SEPARATOR);
        // 根路径
        define('_SITE_ROOT_', str_replace('/includes', '', str_replace('\includes', '', dirname(__FILE__))) . DS);
        // 控制层路径
        define('_ACTION_DIR_', _SITE_ROOT_ . 'action' . DS);
        // 数据层（表操作）路径
        define('_DAL_DIR_', _SITE_ROOT_ . 'dal' . DS);
        // 模型层路径
        define('_DMODEL_DIR_', _SITE_ROOT_ . 'dmodel' . DS);
        // 视图层路径
        define('_TEMPLATES_DIR_', _SITE_ROOT_ . 'templates' . DS);
        // 缓存目录路径
        define('_TEMP_DIR_', _SITE_ROOT_ . 'temp' . DS);
        // 基础公共方法路径
        define('_INCLUDES_DIR_', _SITE_ROOT_ . 'includes' . DS);
        // 数据层-（逻辑与表操作关联）路径
        define('_MODEL_DIR_', _SITE_ROOT_ . 'model' . DS);
        // 插件路径
        define('_VENDORS_DIR_', _SITE_ROOT_ . 'vendors' . DS);
        // 配置文件路径
        define('_CONFIG_DIR_', _SITE_ROOT_ . 'config' . DS);
    }

    /**
     * 初始化请求参数
     */
    private static function initRequest()
    {
        define('_ACTION_', isset($_GET['a']) ? $_GET['a'] : 'index');
        define('_METHOD_', isset($_GET['m']) ? $_GET['m'] : 'index');
        unset($_GET['a'], $_GET['m']);//删除$_GET中的_a _m数据
    }

    /**
     * 载入配置文件
     */
    private static function loadConfig()
    {
        require_once _CONFIG_DIR_ . 'config.php';
        require_once _CONFIG_DIR_ . 'dic.config.php';
        require_once _CONFIG_DIR_ . 'siteurl.config.php';
    }

    /**
     * 载入公共方法
     */
    private static function loadPublic()
    {
        require_once _INCLUDES_DIR_ . 'publicfunc.class.php';
        require_once _INCLUDES_DIR_ . 'encrypt.class.php';
        require_once _INCLUDES_DIR_ . 'page.class.php';
        //引入是smarty模版
        require_once _VENDORS_DIR_ . 'smarty/Smarty.class.php';
        
    }

    /**
     * 载入用户自定义SESSION,SESSION跨域
     */
    private static function loadSession(){
        require_once _INCLUDES_DIR_ . 'sessionmysql.class.php';
        global $db_config;
        $langdb = datamodel::getInstance($db_config);
        $session = new session($langdb);
    }
    
    /**
     * 载入用户处理类
     */
    private static function loadUserHandlerSession()
    {
        require_once _INCLUDES_DIR_ . 'sessionuserhandler.class.php';
        $iu = isset($_SERVER['HTTP_HOST'])?funcPunlic::encryptionUrl("http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']):'';
        global $sessionuserhandler;
        $sessionuserhandler = new sessionuserhandler($iu);
    }

    /**
     * 自动加载函数
     *
     * @param unknown $class_name            
     */
    public static function user_autoload($class_name)
    {
        // 特例
        $map = array(
            'DBMysql' => _DAL_DIR_ . 'mysql.class.php',
            'datamodel' => _DAL_DIR_ . 'datamodel.class.php'
        );
        
        // 判断当前所需要加载的类是否是特例类
        if (isset($map[$class_name])) {
            require_once $map[$class_name];
        } elseif (substr($class_name, - 3) == 'Dal') {
            require_once _DAL_DIR_ . "joe/" . rtrim($class_name, 'Dal') . '.d.class.php';
        } elseif (substr($class_name, - 6) == 'Dmodel') {
            require_once _DMODEL_DIR_ . "joe/" . rtrim($class_name, 'Dmodel') . '.dm.class.php';
        } elseif (substr($class_name, - 2) == 'Do') {
            require_once _ACTION_DIR_ . rtrim($class_name, 'Do') . '.a.class.php';
        } 
    }

    /**
     * 运行
     */
    private static function dispatch()
    {
        //
        if('users' === _ACTION_ || 'action' === _ACTION_){
            init::error('Forbidden');
        }
        $action = _ACTION_. 'Do';
        $method = _METHOD_;
        if(!(class_exists($action) && is_callable(array($action, $method)))){
            init::error('404 Not Found');
        }
        $c = new $action();
        $c -> $method();
    }
    
    public static function error($msg){
        header('HTTP/1.1 404 Not Found');
        header('Status:404 Not Found');// 确保FastCGI模式下正常
        //TODO 输出404 页面 暂时只是输出字符串处理
        echo $msg;
        exit;
    }
}
?>
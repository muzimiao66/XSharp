<?php
/**
 * lgsec1.0
 * @author lgs
 * @time 2018/8/2
 */


//app 目录地址 
if(!define('APP_DIR')){
    define('APP_DIR', ROOT_DIR.'/app');
}
//public 目录地址
if(!define('PUBLIC_DIR')){
    define('PUBLIC_DIR',ROOT_DIR.'/public');
}
//预留了 ecae_mode 变量预定义
error_reporting(E_ALL ^ E_NOTICE);

//ego version 加密文件
if(file_exists(ROOT_DIR.'/app/base/ego/ego.php')){
    require_once (ROOT_DIR.'/app/base/ego/ego.php');
}

//定义系统常量 配置
define('LOG_SYS_EMERG',0);
define('LOG_SYS_ALERT', 1);
define('LOG_SYS_CRIT', 2);
define('LOG_SYS_ERR', 3);
define('LOG_SYS_WARNING', 4);
define('LOG_SYS_NOTICE',5);
define('LOG_SYS_INFO', 6);
define('LOG_SYS_DEBUG', 7);

class kernel
{  
    static $base_url = null;
    static $url_app_map = array();
    static $app_url_map = array();
    static $console_output = FALSE;
    static private $__online = NULL;
    static private $__router = NULL;
    static private $__db_instance = NULL;
    static private $__request_instance = NULL;
    static private $__single_apps = array();
    static private $__service_list = array();
    static private $__base_url = array();
    static private $__language = NULL;
    static private $__service = array();
    static private $__require_config = NULL;
    static private $__host_mirrors = NULL;
    static private $__host_mirrors_count = NULL;
    static function boot(){
//         set_error_handler(array('kernel','exception_error_handler'));
        echo '这是boot';
//         try {
//             if(!self::register_au){
                
//             }
//         }catch (){
            
//         }
    }
    static function autoload($class_name)
    {
        //$p b2c_ctl_wap_brand
        //$p b2c_mdl_cart
        //b2c_order_cancel
        $p = strpos($class_name,'_');
        if($p){
            $owner = substr($class_name,0,$p);
            $class_name = substr($class_name,$p+1);
            $tick = substr($class_name,0,4);
            switch ($tick){
                case 'ctl_':
                    if (define('CUSTOM_CORE_DIR') && file_exists(CUSTOM_CORE_DIR.'/'.$owner.'/controller/'.
                    str_replace('_','/',substr($class_name, 4).'.php'))){
                        $path = CUSTOM_CORE_DIR.'/'.$owner.'/controller/'.str_replace('_','/', substr(
                        $class_name, 4)).'.php';
                    }else {
                        $path = APP_DIR.'/'.$owner.'/controller/'.str_replace('_','/',substr($class_name, 4)).
                        '.php';
                    }
                    if(file_exists($path)){
                        return require_once $path;
                    }else{
                        throw new Exception('Don\'t find controller file');
                        exit;
                    }
                case 'mdl_':
                    if(defined('CUSTOM_CORE_DIR') && file_exists(CUSTOM_CORE_DIR.'/'.$owner.'/model/'.
                    str_replace('_', '/', substr($class_name, 4)).'.php')){
                        $path = CUSTOM_CORE_DIR.'/'.owner.'/model/'.str_replace('_', '/',substr($class_name, 4)).'.php';
                    }else {
                        $path = APP_DIR.'/'.$owner.'/model/'.str_replace('_', '/', substr($class_name, 4)).'.php';
                    }
                    if(file_exists($path)){
                        return require_once $path;
                    }elseif (file_exists(APP_DIR.'/'.$owner.'/dbschema/'.substr($class_name, 4).'.php') || 
                        file_exists(CUSTOM_CORE_DIR.'/'.$owner.'/dbschema/'.substr($class_name, 4).'.php')){
                        
                    }
                default:
            }
        }elseif (1){
            return '';
        }else {
            return '';
        }
        
    }
    
    
    //获取平台设置语言
    static public function get_lang()
    {
        return self::$__language ? self::$__language : ((define('LANF')&&constant('LANG'))?LANG:'zh_CN');
    }
    
}

//未知gettext.inc 文件作用
if(!function_exists('gettext')){
    require_once(APP_DIR.'/base/lib/static/gettext.inc');
}

//加载“__”函数
if(!function_exists('__')){
    function __($str){
        return $str;
    }
}

<?php
/**
 * app 项目模块app
 */
class app
{
    static private $__instance = array();
    static private $__language = null;
    private $__render = null;
    private $__router = null;
    private $__define = null;
    private $__taskrunner = null;
    private $__checkVaryArr = array();
    private $__langPack = array();
    private $__installed = null;
    private $__actived = null;
    private $__setting = null;
    
    
    function __construct($app_id){
        $this->app_id = $app_id;
        $this->app_dir = APP_DIR.'/'.$app_id;
        $this->public_app_dir = PUBLIC_DIR.'/app/'.$app_id;
        
    }
    
}
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
        $this->res_url = kernel::get_app_statics_host_url().'/'.$app_id.'/statics';
        $this->lang_url = kernel::get_app_statics_host_url().'/'.$app_id.'/lang';
        $this->lang_full_url = kernel::get_app_statics_host_url().'/'.$app_id.'/lang';
        $this->widgets_url = kernel::get_app_statics_host_url().'/'.$app_id.'/widgets';
        $this->widgets_full_url = kernel::get_app_statics_host_url().'/'.$app_id.'/widgets';
        
        $this->res_dir = PUBLIC_DIR.'/app/'.$app_id.'/statics';
        $this->widgets_dir = PUBLIC_DIR.'/app/'.$app_id.'/widgets';
        $this->lang_dir = PUBLIC_DIR.'/app/'.$app_id.'/lang';
        //$this->lang_resource = lang::get_res($app_id); //todo:得到语言包资源文件结构
        $this->_lang_resource = null;
    }
    
    //单例模式 
    static function get($app_id){
        if(!isset(self::$__instance[$app_id])){
            self::$__instance[$app_id] = new app($app_id);
        }
        return self::$__instance[$app_id];
    }
    
    //获取 lang 的语言包
    public function lang_resource($lang = null){
        if(!isset($this->_lang_resource)){
            $this->_lang_resource = lang::get_res($this->app_id);
        }
        return !isset($lang)?$this->_lang_resource:$this->_lang_resource[$lang];
    }
    
    //未 知 函 数
    public function _($key){
       //return null
    }
    
    //取得语言包数据
    public function lang($res= null,$key= null){
      return lang::get_info($this->app_id,$res,$key); 
    }
    
    //render 函数
    public function render(){
        if(!$this->__render){
            $this->__render = new base_render($this);
        }
        return $this->__render;
    }
    
    
}
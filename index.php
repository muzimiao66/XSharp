<?php
/**
 * lgsec 唯一入口
 */
define('ROOT_DIR',realpath(dirname(__FILE__)));
require(ROOT_DIR.'/app/base/kernel.php');
kernel::boot();

/*扩展配置？*/
/*
if(defined("STRESS_TESTING")){
    b2c_forStressTest::logSqlAmount();
}
 */


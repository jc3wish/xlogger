<?php
/**
 *  test   
 *
 * @package test
 * @author  zero<jc3wish@126.com>
 */

 /*
	配置　xlogger　目录
 */

define('XLOGGER_API_PATH',dirname(dirname(__FILE__)).'/xlogger');

/**
 * 加载必须文件
*/

require(XLOGGER_API_PATH.'/base.inc.php');

use xlogger\module\XLogger as XLogger;

#项目名称 
define('PROJECT_NAME','test');

class xlogger{
	private static $_instance = null;
	
	/**
	* 架构函数
	*/
	private function __construct() 
	{
		
    }
	
	/**
	* 单例模式
	*/
	public static function getInstance() {
		if (empty(self::$_instance)) {
			$obj = new self();
			self::$_instance = $obj->getXlogger();
		}
		return self::$_instance;
    }
    
    private function getXlogger(){
    	return XLogger::getInstance(PROJECT_NAME);
    }
}


$obj = xlogger::getInstance();
$obj->setM('test4')->setData(array('userId'=>1112,'addTime'=>date('Y-m-d H:i:s'),'content'=>'nothing'));
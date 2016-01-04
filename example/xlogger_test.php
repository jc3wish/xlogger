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

$obj = XLogger::getInstance("test");

$data = array('userId'=>111,'info'=>'it is test info');

$r = $obj->setM('test4')->getSource($data);
print_r($r);

$obj->setM('test4')->setData($data);

$obj->setM('test2')->setData($data);
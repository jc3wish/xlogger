<?php
ini_set('display_errors','On'); 
error_reporting(E_ALL);
#error_reporting(E_ERROR | E_WARNING | E_PARSE);
/**
 *  API  文件基础文件 
 *
 * @package api
 * @subpackage ./
 * @author  谢<jc3wish@126.com>
 */

 /*
	配置　API　目录
 */
define('XLOGGER_API_PATH',dirname(dirname(__FILE__)).'/xcore_project/xlogger');

/**
 * 加载必须文件
*/

require(XLOGGER_API_PATH.'/base.inc.php');

use xlogger\module\XLogger as XLogger;

$objtest = XLogger::getInstance('test');

@$objtest->setM('test4');
print_r($objtest->getSource(array('key'=>'333333333','userId'=>102)));
@$r = $objtest->setData(array('key'=>'333333333','userId'=>102));
print_r($r);
exit();
exit('over');

$objtest->setM('test');
$r = $objtest->setData(array('key'=>'sdfs222'));
print_r($r);

$objtest = XLogger::getInstance('test');

$objtest->setM('test2');
$r = $objtest->setData(array('key'=>'22222'));
print_r($r);


$objtest->setM('test3');
$r = $objtest->setData(array('key'=>'333333333'));
print_r($r);


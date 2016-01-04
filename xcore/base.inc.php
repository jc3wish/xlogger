<?php
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
if( !defined('XCORE_API_PATH') )
{
	define('XCORE_API_PATH',dirname(dirname(__FILE__)));
}

require XCORE_API_PATH.'/static/xstatic.class.php';

function __autoload($className) {
	xstatic::autoload($className);
}

xstatic::setAlias('orm', XCORE_API_PATH.'/orm');
xstatic::setAlias('nosql', XCORE_API_PATH.'/nosql');
xstatic::setAlias('factory', XCORE_API_PATH.'/factory');

use \orm\Mysql_DB as MySQL_DB;
use \nosql\Redis_Cache as Redis_DB;
use \nosql\Mongodb as Mongodb;
use \factory\XFactory as XFactory;
 
## xlogger,a log system for php

一切都是服务，下面是开发思维图

https://www.processon.com/view/link/568a2b01e4b03a0f103b291c

https://www.processon.com/view/link/568a221be4b03a0f103a683d

#### xcore

核心资源管理文件，redis,mongodb,mysql等连接管理

#### xlogger

xlogger服务代码所在文件夹

- config ( 配置文件夹，一个项目一个文件)
- module ( 调用redis，mongodb,file等资源进行存储模块 )
- rule   ( 日志存储分布规则 )

#### config 配置文件
`````php
return array(
	//日志模块
	'test'=>array(
		'db'=>'redis',//用什么存储 file,mongodb,redis
		'base'=>array(    // redis array, mongodb conn string. file dir string
			'host'=>'localhost',
			'port'=>6379,
		),
		'rule'=>array(
			'class'=>'xlogger\rule\XLogger_Rule_Time',   // 选择用哪一个规则分布
			'param'=>array(
				'prefix'=>'test',
				'partition'=>'Y-m',// Y-m-d
				'database'=>0,  // 哪一个库
			),
			'key'=>'addTime',		// 选择用哪一个字段进行拆分
		),
		'format'=>'json', //目前只支持这格式 并且默认也是这个
	),
	'test3'=>array(
		'db'=>'mongodb',//用什么存储
		'base'=>'mongodb://127.0.0.1:27017',
		'rule'=>array(
			'class'=>'xlogger\rule\XLogger_Rule_Time',
			'param'=>array(
				'prefix'=>'test',
				'partition'=>'Y-m-d',// Y-m-d
				'database'=>'logtestdb',
			),
			'key'=>'addTime',
		),
		'format'=>'json',
	),
	'test4'=>array(
		'db'=>'file',//用什么存储
		'base'=>dirname(__FILE__),
		'rule'=>array(
			'class'=>'xlogger\rule\XLogger_Rule_Long',
			'param'=>array(
				'prefix'=>'test',
				'tableCount'=>10,				//所有分几个表，  tableLength 为总的每个表多少条记录 ，如果都设置有  按 tableCount 优先
				'database'=>'logtestdb',     // 当db 为 file 时，这个值无效，redis为必须为数字，因为redis库是0-7 这样的数字划分的
			),
			'key'=>'userId',
		),
		'format'=>'json',
	),
)
`````

#### rule 规则
rule 规则现在很简单
- xlogger\rule\XLogger_Rule_Time ( 按时间拆分，通过设置参数 partition 日期格式来分 Y-m-d 为按天分，Y-m 按月，默认Y-m)
- xlogger\rule\XLogger_Rule_Long ( 按数字进行拆分，tableCount：总的分几个表 ; tableLength 每个表存多少条记录; tableCount 规则优先)


#### Example
`````php

 /*
	 ci 框架中index.php 中加载这个文件
 */

define('XLOGGER_API_PATH',dirname(dirname(__FILE__)).'/xlogger');

/**
 * 加载必须文件
*/

require(XLOGGER_API_PATH.'/base.inc.php');

use xlogger\module\XLogger as XLogger;

//项目名称 
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

//调用
$obj = xlogger::getInstance();
$obj->setM('test4')->setData(array('userId'=>1112,'addTime'=>date('Y-m-d H:i:s'),'content'=>'nothing'));

`````

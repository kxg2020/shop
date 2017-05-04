<?php
//phpinfo();
//$m = new \Memcache();
//var_dump($m);
//exit;
// 检查环境
version_compare(PHP_VERSION, '5.3.0', '<') && die('版本太低');

// 定义路径
define('APP_PATH', __DIR__ . '/../Application/');

define('URL', 'http://www.shop.com');

define('BIND_MODULE', 'Home');
// 定义调试模式
define('APP_DEBUG', true);

// 加载TP的入口文件
require __DIR__ . '/../ThinkPHP/ThinkPHP.php';
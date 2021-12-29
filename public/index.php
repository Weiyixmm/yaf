<?php

/* 定义这个常量是为了在application.ini中引用*/
define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../'));

$application = new \Yaf\Application(APPLICATION_PATH . "/conf/application.ini", 'product');

# 线上环境不打印错误
if (\Yaf\ENVIRON == 'product' && config('display_errors')) {
    error_reporting(0);
} else {
    error_reporting(E_ALL & ~E_WARNING);
}

$application->bootstrap()->run();
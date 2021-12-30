<?php
/**
 * Created PhpStorm.
 * User: liyw<634482545@qq.com>
 * Date: 2020-11-19
 * File: cli.php
 * Desc: Cli 模式入口文件
 */
php_sapi_name() == 'cli' or exit('no authority.');

define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../'));

$application = new \Yaf\Application(APPLICATION_PATH . "/conf/application.ini");

if ($argc < 2 || empty($file = ($argv[1] ?? ''))) {
    exit("  usage: php cli.php <[namespace]class>/<method> [params_json]\nexample: php cli.php once/Demo/execute '{\"class\": \"Demo\", \"method\": \"execute\"}'");
}

$parseClass = explode('/', $file);

$method = array_pop($parseClass);

if (!empty($json = ($argv[2] ?? '')) && !$param = json_decode($json, true)) {
    exit(sprintf('%s decode error: %s.', $json, json_last_error_msg()));
}

$nameSpaceClass = "app\\cli\\" . implode('\\', $parseClass);

$application->bootstrap()->execute([new $nameSpaceClass(), $method], $param ?? []);
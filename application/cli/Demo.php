<?php
/**
 * Created PhpStorm.
 * User: liyw<634482545@qq.com>
 * Date: 2020-11-19
 * File: Demo.php
 * Desc: Cron 示例
 */

namespace app\cli;

/**
 * Class Demo
 * @package app\cli
 */
class Demo
{
    /**
     * php cli.php Demo/execute '{"class": "Demo", "method": "execute"}'
     * @author liyw<2020-11-19>
     * @param array $param
     */
    public function execute(array $param = [])
    {
        $class  = $param['class'] ?? 'Class';
        $method = $param['method'] ?? 'method';
        exit("This is a cli demo. Class: {$class}, Method: {$method}.");
    }
}
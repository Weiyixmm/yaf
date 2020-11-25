<?php
/**
 * Created PhpStorm.
 * User: liyw<634482545@qq.com>
 * Date: 2020-11-19
 * File: Demo.php
 * Desc: Cron 示例
 */

namespace app\cron;

/**
 * Class Demo
 * @package app\cron
 */
class Demo
{
    /**
     * php cli.php Demo.execute '{"class": "Demo", "method": "execute"}'
     * @author liyw<2020-11-19>
     * @param $param
     */
    public function execute($param = [])
    {
        exit("This is a cli demo. Class: {$param['class']}, Method: {$param['method']}.");
    }
}
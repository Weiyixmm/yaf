<?php
/**
 * Created PhpStorm.
 * User: liyw<634482545@qq.com>
 * Date: 2020-10-16
 * File: Response.php
 * Desc: 生成请求、响应类实例
 */

class CommonPlugin extends \Yaf\Plugin_Abstract
{
    public function routerStartup(\Yaf\Request_Abstract $request, \Yaf\Response_Abstract $response)
    {
        # 注册请求对象
        \Yaf\Registry::set('request', new \app\library\core\Request($request));
    }

    public function routerShutdown(\Yaf\Request_Abstract $request, \Yaf\Response_Abstract $response)
    {
        # 注册响应对象
        \Yaf\Registry::set('response', new \app\library\core\Response($response));
    }
}
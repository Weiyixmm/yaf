<?php

/**
 * @name Bootstrap
 * @author weiyi
 * @desc   所有在Bootstrap类中, 以_init开头的方法, 都会被Yaf调用,
 * @see    http://www.php.net/manual/en/class.yaf-bootstrap-abstract.php
 * 这些方法, 都接受一个参数:\Yaf\Dispatcher $dispatcher
 * 调用的次序, 和申明的次序相同
 */
class Bootstrap extends \Yaf\Bootstrap_Abstract
{
    public function _initSeaslog()
    {
        \Seaslog::setBasePath(\Yaf\Application::app()->getConfig()->get('log.path'));
        \Seaslog::setLogger(\Yaf\Application::app()->getConfig()->get('log.logger'));
    }

    public function _initAutoload()
    {
        \Yaf\Loader::getInstance()->registerLocalNamespace(
            '\app', \Yaf\Application::app()->getConfig()->get('application.directory')
        );
    }

    public function _initConfig()
    {
        //把配置保存起来
        $arrConfig = \Yaf\Application::app()->getConfig();
        \Yaf\Registry::set('config', $arrConfig);
    }

    public function _initPlugin(\Yaf\Dispatcher $dispatcher)
    {
        //注册一个插件
        $objSamplePlugin = new SamplePlugin();
        $dispatcher->registerPlugin($objSamplePlugin);
        $objCommonPlugin = new CommonPlugin();
        $dispatcher->registerPlugin($objCommonPlugin);
    }

    public function _initRoute(\Yaf\Dispatcher $dispatcher)
    {
        //在这里注册自己的路由协议,默认使用简单路由
    }

    public function _initView(\Yaf\Dispatcher $dispatcher)
    {
        //在这里注册自己的view控制器，例如smarty,firekylin
        # 开启/关闭自动渲染功能. 在开启的情况下(Yaf默认开启), Action执行完成以后, Yaf会自动调用View引擎去渲染该Action对应的视图模板.
        $dispatcher->autoRender(false);
        # 关闭视图
        $dispatcher->disableView();
        # 是否返回Response对象, 如果启用, 则Response对象在分发完成以后不会自动输出给请求端, 而是交给程序员自己控制输出.
        $dispatcher->returnResponse(true);
    }
}

# 定义常量
define('NOW', time());
define('NOW_DATETIME', date('Y-m-d H:i:s'));

# 全局方法
if (!function_exists('app')) {
    /**
     * 返回Application实例
     * @return mixed
     */
    function app()
    {
        return \Yaf\Application::app();
    }
}

if (!function_exists('registory')) {
    /**
     * 返回已经注册的对象实例
     * @param string $obj_name 已经注册的对象实例名称
     * @return mixed
     */
    function registry($obj_name)
    {
        return $obj_name ? \Yaf\Registry::get($obj_name) : '';
    }
}

if (!function_exists('config')) {
    /**
     * 返回配置数据
     * @param string $config 配置文件Key
     * @return mixed
     */
    function config($config)
    {
        return registry('config')->get($config);
    }
}

if (!function_exists('request')) {
    /**
     * 返回请求实例
     * @return \App\Library\Core\Request
     */
    function request()
    {
        return registry('request');
    }
}

if (!function_exists('resopnse')) {
    /**
     * 返回响应类实例
     * @return \App\Library\Core\Response
     */
    function response()
    {
        return registry('response');
    }
}

if (!function_exists('abort')) {
    /**
     * 响应错误
     * @param array  $error
     * @param string $data
     */
    function abort($error = [], $data = '')
    {
        response()->outputError($error, $data);
    }
}
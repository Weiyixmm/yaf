<?php
/**
 * Created PhpStorm.
 * User: liyw<634482545@qq.com>
 * Date: 2020-11-06
 * File: BaseApi.php
 * Desc: Api module base class.
 */

class BaseApi extends \Yaf\Controller_Abstract
{
    public function init()
    {
        # 初始化方法，类似构造函数
        # code...
    }

    /**
     * 获取参数
     * @author liyw<2020-11-25>
     * @param string $name
     * @param null   $default
     * @param null   $type
     * @param bool   $isMust
     * @param string $msg
     * @return bool|mixed|null
     */
    public function input(string $name = '', $default = null, $type = null, bool $isMust = false, string $msg = '')
    {
        return request()->input($name, $default, $type, $isMust, $msg);
    }

    /**
     * 响应成功结果
     * @param              $data
     * @param array|string $responseStatus
     * @param array        $header
     */
    public function outputSuccess($data, $responseStatus = [], array $header = [])
    {
        response()->outputSuccess($data, $responseStatus, $header);
    }

    /**
     * 响应错误结果
     * @param array|string $responseStatus
     * @param string       $data
     * @param array        $header
     */
    public function outputError($responseStatus, string $data = '', array $header = [])
    {
        response()->outputError($responseStatus, $data, $header);
    }

    /**
     * 输出正常数据
     * @author liyw<2021-03-25>
     * @param       $data
     * @param array $header
     */
    public function output($data, array $header = [])
    {
        response()->output($data, $header);
    }
}
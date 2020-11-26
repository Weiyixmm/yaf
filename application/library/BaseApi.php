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
    public function getParam($name = '', $default = null, $type = null, $isMust = false, $msg = '')
    {
        return request()->input($name, $default, $type, $isMust, $msg);
    }

    /**
     * 响应成功结果
     * @param        $data
     * @param string $msg
     * @param int    $code
     * @param array  $header
     */
    public function outPutSuccess($data, $msg = 'success', $code = 200, $header = [])
    {
        response()->outputSuccess($data, $msg, $code, $header);
    }

    /**
     * 响应错误结果
     * @param array  $error
     * @param string $data
     * @param array  $header
     */
    public function outPutError($error = [], $data = '', $header = [])
    {
        response()->outputError($error, $data, $header);
    }
}
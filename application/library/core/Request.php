<?php
/**
 * Created PhpStorm.
 * User: liyw<634482545@qq.com>
 * Date: 2020-10-16
 * File: Request.php
 * Desc: 请求类处理
 */

namespace app\library\core;

class Request
{
    private $_request;

    public function __construct($request)
    {
        $this->_request = $request;
    }

    /**
     * 参数获取
     * @author liyw<2020-11-17>
     * @param string $name    参数名称(eg: json.|json.id|id)
     *                        "json."，返回json转换的数组;
     *                        "json.id"，返回数组中的值
     *                        body 体为json，使用"json."，如果为xml，使用"xml."(自行实现)
     * @param null   $default 默认值
     * @param null   $type    返回值类型，NULL不做转换
     * @param bool   $isMust  是否是必传参数(true，默认值应为NUll(default = null))
     * @param string $msg     string|array(string: 错误信息，array: ['errorcode', 'errormsg'])
     * @return bool|mixed|null
     */
    public function input(string $name = '', $default = null, $type = null, bool $isMust = false, string $msg = '')
    {
        if (FALSE === strpos($name, '.')) {
            $param = $this->_request->get($name, $default);
        } else {
            list($rawType, $rawName) = explode('.', $name, 2);

            $rawVal = $this->_request->getRaw();

            switch (strtolower($rawType)) {
                default :
                case 'json':
                    $parseRaw = json_decode($rawVal, true);
                    break;
                case 'xml':
                    # code...
                    break;
            }

            if (empty($rawName)) {
                return $parseRaw ?? [];
            } else {
                $param = ($parseRaw[$rawName] ?? '') ?: $default;
            }
        }

        if ($isMust && is_null($param ?? null)) {
            if (empty($msg)) {
                outputError([ResponseStatus::INPUT_ERROR_CODE, ResponseStatus::INPUT_ERROR_MSG]);
            } elseif (is_array($msg)) {
                outputError($msg);
            } else {
                outputError([ResponseStatus::INPUT_ERROR_CODE, $msg]);
            }
        }

        switch ($type) {
            default:
                break;
            case 'string':
                settype($param, 'string');
                break;
            case 'int':
                settype($param, 'int');
                break;
            case 'float':
                settype($param, 'float');
                break;
            case 'bool':
                settype($param, 'bool');
                break;
        }

        return $param;
    }
}
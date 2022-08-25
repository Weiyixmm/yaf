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
     * @author liyw<2022-08-25>
     * @param string $name
     * @param null   $default
     * @param null   $type
     * @param bool   $isMust
     * @param string $msg
     * @return array|mixed|null
     */
    public function input(string $name = '', $default = null, $type = null, bool $isMust = false, string $msg = '')
    {
        # 获取所有类型的请求数据
        $file   = $this->_request->getFiles();
        $params = $this->_request->getParams();
        $query  = $this->_request->getQuery();
        $post   = $this->_request->getPost() ?: (json_decode($this->_request->getRaw(), true) ?: []);

        # 合并数据
        $input = array_merge($post, $params, $query, $file);

        # 没有字段，返回所有数据
        if (empty($name)) {
            return $input;
        }

        # 获取字段值
        $param = $input[$name] ?? $default;

        # 必传参数过滤
        if ($isMust && is_null($param ?? null)) {
            if (empty($msg)) {
                outputError([ResponseStatus::INPUT_ERROR_CODE, ResponseStatus::INPUT_ERROR_MSG]);
            } elseif (is_array($msg)) {
                outputError($msg);
            } else {
                outputError([ResponseStatus::INPUT_ERROR_CODE, $msg]);
            }
        }

        # 类型转换
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

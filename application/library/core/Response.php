<?php
/**
 * Created PhpStorm.
 * User: liyw<634482545@qq.com>
 * Date: 2020-10-16
 * File: Response.php
 * Desc: 响应处理文件
 */

namespace app\library\core;

class Response
{
    /**
     * @var Response
     */
    private $_response;

    public function __construct($response)
    {
        $this->_response = $response;
    }

    /**
     * 响应错误结果
     * @param array  $error
     * @param string $data
     * @param array  $header
     */
    public function outputError($error = [], $data = '', $header = [])
    {
        $out = [
            'code' => $error[0] ?? 0,
            'msg'  => $error[1] ?? 'fail',
            'time' => NOW,
            'data' => is_bool($data) ? $data : ($data ?: []),
        ];

        $this->setHeader($header);

        $this->_response->setBody(json_encode($out, JSON_UNESCAPED_UNICODE));
        $this->_response->response();
        exit();
    }

    /**
     * 响应成功结果
     * @param        $data
     * @param string $msg
     * @param int    $code
     * @param array  $header
     */
    public function outputSuccess($data, $msg = 'success', $code = 200, $header = [])
    {
        $out = [
            'code' => $code,
            'msg'  => $msg,
            'time' => NOW,
            'data' => is_bool($data) ? $data : ($data ?: []),
        ];

        $this->setHeader($header);

        $this->_response->setBody(json_encode($out, JSON_UNESCAPED_UNICODE));
        $this->_response->response();
    }

    /**
     * 设置Header
     * @param array $header
     */
    private function setHeader($header = [])
    {
        if (!empty($header)) {
            foreach ($header as $type => $value) {
                $this->_response->setHeader($type, $value);
            }
        } else {
            $this->_response->setHeader('Content-Type', 'application/json; charset=utf-8');
        }
    }
}
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
     * @param array|string $responseStatus
     * @param string       $data
     * @param array        $header
     */
    public function outputError($responseStatus, string $data = '', array $header = [])
    {
        $responseStatus = is_array($responseStatus) ? $responseStatus : [ResponseStatus::NORMAL_ERROR_CODE, $responseStatus];

        $out = [
            'code' => $responseStatus[0] ?? ResponseStatus::NORMAL_ERROR_CODE,
            'msg'  => $responseStatus[1] ?? ResponseStatus::NORMAL_ERROR_MSG,
            'time' => NOW,
            'data' => is_bool($data) ? $data : ($data ?: []),
        ];

        $this->output(json_encode($out, JSON_UNESCAPED_UNICODE), $header);
    }

    /**
     * 响应成功结果
     * @param              $data
     * @param array|string $responseStatus
     * @param array        $header
     */
    public function outputSuccess($data, $responseStatus = [], array $header = [])
    {
        $responseStatus = is_array($responseStatus) ? $responseStatus : [ResponseStatus::NORMAL_SUCCESS_CODE, $responseStatus];

        $out = [
            'code' => $responseStatus[0] ?? ResponseStatus::NORMAL_SUCCESS_CODE,
            'msg'  => $responseStatus[1] ?? ResponseStatus::NORMAL_SUCCESS_MSG,
            'time' => NOW,
            'data' => is_bool($data) ? $data : ($data ?: []),
        ];

        $this->output(json_encode($out, JSON_UNESCAPED_UNICODE), $header);
    }

    /**
     * @author liyw<2021-03-25>
     * @param       $data
     * @param array $header
     */
    private function output($data, array $header = [])
    {
        $this->setHeaders($header);

        $this->_response->setBody($data);
        $this->_response->response();
        exit();
    }

    /**
     * 设置Header
     * @param array $header
     */
    public function setHeaders(array $header = [])
    {
        # cros、json header
        $crosHeader = [
            'Access-Control-Allow-Headers' => 'Origin, X-Requested-With, Content-Type, Accept, Authorization',
            'Access-Control-Allow-Methods' => 'GET, POST, PUT',
            'Access-Control-Allow-Origin'  => '*',
            'Content-Type'                 => 'application/json; charset=utf-8',
        ];

        if ($handleHeader = ($header ?: $crosHeader)) {
            foreach ($handleHeader as $type => $value) {
                $this->_response->setHeader($type, $value);
            }
        }
    }
}
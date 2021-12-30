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
            'statusCode' => $responseStatus[0] ?? ResponseStatus::NORMAL_ERROR_CODE,
            'msg'        => $responseStatus[1] ?? ResponseStatus::NORMAL_ERROR_MSG,
            'time'       => NOW,
            'data'       => is_bool($data) ? $data : ($data ?: []),
        ];

        $this->setHeaders($header);

        $this->_response->setBody(json_encode($out, JSON_UNESCAPED_UNICODE));
        $this->_response->response();
        exit();
    }

    /**
     * 响应成功结果
     * @param              $data
     * @param array|string $responseStatus
     * @param array        $header
     */
    public function outputSuccess($data, $responseStatus, array $header = [])
    {
        $responseStatus = is_array($responseStatus) ? $responseStatus : [ResponseStatus::NORMAL_SUCCESS_CODE, $responseStatus];

        $out = [
            'statusCode' => $responseStatus[0] ?? ResponseStatus::NORMAL_SUCCESS_CODE,
            'msg'        => $responseStatus[1] ?? ResponseStatus::NORMAL_SUCCESS_MSG,
            'time'       => NOW,
            'data'       => is_bool($data) ? $data : ($data ?: []),
        ];

        $this->setHeaders($header);

        $this->_response->setBody(json_encode($out, JSON_UNESCAPED_UNICODE));
        $this->_response->response();
        exit();
    }

    /**
     * @author liyw<2021-03-25>
     * @param       $data
     * @param array $header
     */
    public function output($data, array $header = [])
    {
        # 存在header，设置header
        if ($header) {
            $this->setHeaders($header);
        }

        $this->_response->setBody($data);
        $this->_response->response();
        exit();
    }

    /**
     * 设置Header
     * @param array $header
     */
    private function setHeaders(array $header = [])
    {
        if (!empty($header)) {
            foreach ($header as $type => $value) {
                $this->_response->setHeader($type, $value);
            }
        } else {
            $this->_response->setHeader(
                'Access-Control-Allow-Headers',
                'Origin, X-Requested-With, Content-Type, Accept'
            );
            $this->_response->setHeader('Access-Control-Allow-Methods', 'GET, POST, PUT');
            $this->_response->setHeader('Access-Control-Allow-Origin', '*');
            $this->_response->setHeader('Content-Type', 'application/json; charset=utf-8');
        }
    }
}
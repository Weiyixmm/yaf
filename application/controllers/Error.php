<?php

/**
 * @name ErrorController
 * @desc   错误控制器, 在发生未捕获的异常时刻被调用
 * @see    http://www.php.net/manual/en/yaf-dispatcher.catchexception.php
 * @author weiyi
 */
class ErrorController extends \Yaf\Controller_Abstract
{
    /**
     * 忽略uri字典
     */
    private static $ignoreUriDict = [
        '/favicon.ico',
    ];

    //从2.1开始, errorAction支持直接通过参数获取异常
    public function errorAction($exception)
    {
        $requstUri = $this->getRequest()->getRequestUri();

        if (!in_array($requstUri, self::$ignoreUriDict)) {
            $code    = $exception->getCode();
            $message = $exception->getMessage();
            $file    = $exception->getFile();
            $line    = $exception->getLine();
            $trace   = $exception->getTrace();

            \Seaslog::error(
                'catch_exception: {exception_info}',
                [
                    'exception_info' => json_encode([
                        'uri'     => $requstUri,
                        'code'    => $code,
                        'message' => $message,
                        'file'    => $file,
                        'line'    => $line,
                        'trace'   => $trace,
                    ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
                ]
            );

            outputError([\app\library\core\ResponseStatus::EXCEPTION_CODE, \app\library\core\ResponseStatus::EXCEPTION_MSG]);
        }
    }
}

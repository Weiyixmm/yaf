<?php
/**
 * Created PhpStorm.
 * User: liyw<634482545@qq.com>
 * Date: 2020-10-19
 * File: ResponseStatus.php
 * Desc: 错误码
 */

namespace app\library\core;

class ResponseStatus
{
    const EXCEPTION_CODE = -1;
    const EXCEPTION_MSG  = '系统异常';

    const INPUT_ERROR_CODE = -100;
    const INPUT_ERROR_MSG  = '无效的参数';

    /**
     * 成功请求 code、msg(当默认值使用，不可单独使用)
     */
    const NORMAL_SUCCESS_CODE = 200;
    const NORMAL_SUCCESS_MSG  = 'success';

    /**
     * 失败请求 code、msg(当默认值使用，不可单独使用)
     */
    const NORMAL_ERROR_CODE = 100001;
    const NORMAL_ERROR_MSG  = 'fail';
}
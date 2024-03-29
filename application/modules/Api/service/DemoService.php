<?php
/**
 * Created PhpStorm.
 * User: liyw<634482545@qq.com>
 * Date: 2020-11-25
 * File: DemoService.php
 * Desc: 示例逻辑层
 */

namespace app\modules\Api\service;

use app\library\redis\Redis;
use DemoModel;

class DemoService
{
    public $id;

    protected $_demoModel;

    public function __construct()
    {
        $this->_demoModel = new DemoModel();
    }

    /**
     * 查询数据库使用示例
     * @author liyw<2021-12-30>
     * @return false|mixed|void
     */
    public function showUsageForSelectDB()
    {
        return $this->_demoModel->showUsageForSelectDB($this->id);
    }

    /**
     * redis使用示例
     * @author liyw<2021-12-30>
     * @return false|mixed|string
     */
    public function showUsageForRedis()
    {
        Redis::getRedis()->set('redis_key', 'redis_value', ['EX' => 60]);

        return Redis::getRedis()->get('redis_key');
    }

    /**
     * service中途报错方法使用示例
     * @author liyw<2021-12-30>
     */
    public function showOutputServiceErrorUsage()
    {
        outputError('service中途报错');
    }

    /**
     * model中途报错方法使用示例
     * @author liyw<2021-12-30>
     */
    public function showUsageModelOutputError()
    {
        $this->_demoModel->modelOutputError();
    }
}
<?php
/**
 * Created PhpStorm.
 * User: liyw<634482545@qq.com>
 * Date: 2020-11-18
 * File: Demo.php
 * Desc: 样例控制器
 */

use app\modules\api\service\DemoService;

class DemoController extends BaseApi
{
    /**
     * @var DemoService
     */
    protected $_demoService;

    public function init()
    {
        # 继承父类初始化方法，不写则不继承
        parent::init();
        # 实例化Service
        $this->_demoService = new DemoService();
    }

    /**
     * 使用示例
     * http://localhost/api/Demo/showUsage
     * @author liyw<2020-11-25>
     */
    public function showUsageAction()
    {
        # 使用全局方法获取参数(父类方法是封装的全局方法，使用方式一样)
        $getParam = request()->input('id', null, 'int', true, 'invalid id.');

        # 使用父类方法获取参数
        $getParam = $this->getParam('id', null, 'int', true, 'invalid id.');

        # 获取json格式数据的数组格式
        $getRaw = $this->getParam('json.');

        # 获取json格式数据的某个键值
        $getRawParam = $this->getParam('json.id', 0, 'int');

        # service 使用方法
        $this->_demoService->id = 1;
        $res = $this->_demoService->demo();

        # 全局方法，响应数据
        # response()->outputSuccess($res);

        # 父类方法，响应数据
        $this->outPutSuccess($res);
    }

    /**
     * log使用方法示例
     * 更多Seaslog使用方法，请参考扩展
     * @link   https://www.php.net/manual/zh/book.seaslog.php
     * @author liyw<2020-11-20>
     */
    public function showLogUsageAction()
    {
        \Seaslog::info(
            'This is a log usage. The log path: {path}, log logger: {logger}',
            ['path' => config('log.path'), 'logger' => config('log.logger')]
        );

        exit(
        sprintf(
            'This is a log usage. The log path: %s, log logger: %s',
            config('log.path'),
            config('log.logger')
        )
        );
    }
}
<?php
/**
 * Created PhpStorm.
 * User: liyw<634482545@qq.com>
 * Date: 2020-11-18
 * File: Demo.php
 * Desc: 样例控制器
 */

use app\modules\Api\service\DemoService;

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
     * 必须参数使用示例
     * @author liyw<2020-11-25>
     */
    public function showUsageForMustInputAction()
    {
        $input = $this->input('id', null, 'int', true, 'invalid id.');
    }

    /**
     * 请求参数使用实例
     * @author liyw<2021-12-30>
     */
    public function showUsageForInputAction()
    {
        $inputJson = $this->input();

        $id   = $this->input('id', 1, 'int');
        $name = $this->input('name', '', 'string');

        $this->outputSuccess(['json_data' => $inputJson, 'id' => $id, 'name' => $name]);
    }

    /**
     * request、response使用示例
     * @author liyw<2021-12-30>
     */
    public function showUsageForRequestResponseAction()
    {
        $input = $this->input('id', 1, 'int');

        $this->outputSuccess(['input_data' => $input], 'request、response使用示例');
    }

    /**
     * 全局request、response使用示例
     * @author liyw<2021-12-30>
     */
    public function showUsageForGlobalRequestResponseAction()
    {
        $input = request()->input('id', 1, 'int');

        response()->outputSuccess(['input_data' => $input], '全局request、response使用示例');
    }

    /**
     * 查询数据库使用示例
     * @author liyw<2021-12-30>
     */
    public function showUsageForSelectDBAction()
    {
        $this->_demoService->id = $this->input('id', 0, 'int');

        $res = $this->_demoService->showUsageForSelectDB();

        $this->outputSuccess($res);
    }

    /**
     * service中途报错方法使用示例
     * @author liyw<2021-12-30>
     */
    public function showUsageForServiceOutputErrorAction()
    {
        $this->_demoService->showOutputServiceErrorUsage();
    }

    /**
     * model中途报错方法使用示例
     * @author liyw<2021-12-30>
     */
    public function shwoUsageForModelOutputErrorAction()
    {
        $this->_demoService->showUsageModelOutputError();
    }

    /**
     * redis使用示例
     * @author liyw<2021-12-30>
     */
    public function showUsageForRedisAction()
    {
        $res = $this->_demoService->showUsageForRedis();

        $this->outputSuccess($res);
    }

    /**
     * composer包加载
     * @author liyw<2022-01-24>
     */
    public function showUsageForComposerAction()
    {
        # 自动加载composer包(程序初始化时，默认不加载，影响性能)
        autoloadComposer();
    }

    /**
     * log使用方法示例
     * 更多Seaslog使用方法，请参考扩展
     * @link   https://www.php.net/manual/zh/book.seaslog.php
     * @author liyw<2020-11-20>
     */
    public function showUsageForLogAction()
    {
        \Seaslog::info(
            'This is a log usage. The log path: {path}, log logger: {logger}',
            [
                'path'   => config('log.path'),
                'logger' => config('log.logger'),
            ]
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

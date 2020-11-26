<?php
/**
 * Created PhpStorm.
 * User: liyw<634482545@qq.com>
 * Date: 2020-11-25
 * File: DemoService.php
 * Desc: 示例逻辑层
 */

namespace app\modules\api\service;

class DemoService
{
    public $id;

    /**
     * @var \DemoModel
     */
    protected $_demoModel;

    public function __construct()
    {
        $this->_demoModel = new \DemoModel();
    }

    public function demo()
    {
        # Model 使用方法
        return $this->_demoModel->getUserInfo($this->id);
    }
}
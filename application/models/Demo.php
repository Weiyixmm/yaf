<?php
/**
 * Created PhpStorm.
 * User: liyw<634482545@qq.com>
 * Date: 2020-11-18
 * File: Demo.php
 * Desc:
 */

use app\library\database\BaseDB;
use app\library\core\ErrorCode;

class DemoModel
{
    protected $_table = 'wxuser';

    public function getUserInfo($id)
    {
        # 数据库查询方法
        # return BaseDB::getInstance()->get($this->_table, '*', ['userid' => $id]);

        # 中途报错方法
        # abort(ErrorCode::$FAIL);

        return [
            'id'   => $id,
            'name' => 'weiyi',
        ];
    }
}
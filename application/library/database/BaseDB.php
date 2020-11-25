<?php
/**
 * Created PhpStorm.
 * User: liyw<634482545@qq.com>
 * Date: 2020-11-18
 * File: Database.php
 * Desc: 数据库基类
 */

namespace app\library\database;

class BaseDB
{
    /**
     * @var Medoo
     */
    private static $_instance;

    private function __clone()
    {
    }

    private function __construct()
    {
    }

    /**
     * @author liyw<2020-11-19>
     * @return Medoo
     */
    public static function getInstance()
    {
        if (!self::$_instance instanceof self) {
            self::$_instance = new Medoo(
                [
                    'database_type' => config('database.database_type'),
                    'database_name' => config('database.database_name'),
                    'server'        => config('database.server'),
                    'username'      => config('database.username'),
                    'password'      => config('database.password'),

                    # 'collation'     => 'utf8mb4_general_ci',
                    'charset'       => config('database.charset'),
                    'port'          => config('database.port'),
                    'prefix'        => config('database.prefix'),
                    # 是否开启日志，开启会影响性能
                    'logging'       => config('database.logging'),
                ]
            );
        }

        return self::$_instance;
    }
}
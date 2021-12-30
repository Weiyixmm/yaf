<?php
/**
 * Created PhpStorm.
 * User: liyw<634482545@qq.com>
 * Date: 2021-03-16
 * File: Redis
 * Desc: Redis 连接池
 */

namespace app\library\redis;

class Redis
{
    private static $_connections;

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    /**
     * @author liyw<2021-03-16>
     * @param array $options
     * @return \Redis
     */
    public static function getRedis(array $options = []): \Redis
    {
        # 连接实例key
        $instanceKey = self::generateInstanceKey($options);

        # 不存在实例
        if (!isset(self::$_connections[$instanceKey])) {
            # 获取配置信息
            $redisConfig = config('redis.servers');

            # merge自定义配置
            $mergeConfig = array_merge($redisConfig, $options);

            $host       = $mergeConfig['host'];
            $port       = $mergeConfig['port'] ?? 6379;
            $password   = $mergeConfig['password'];
            $timeout    = $mergeConfig['timeout'] ?? 0;
            $persistent = $mergeConfig['persistent'];
            $prefix     = $mergeConfig['prefix'];

            # 连接类型(长连、短连)
            $connectType = $persistent ? 'pconnect' : 'connect';

            # 实例化Redis
            $connection = new \Redis();

            # 连接Redis
            $connection->$connectType($host, $port, $timeout);

            # 存在密码验证密码
            if ($password) {
                $connection->auth($password);
            }

            # 存在前缀，设置前缀
            if ($prefix) {
                $connection->setOption(\Redis::OPT_PREFIX, $prefix);
            }

            # 实例赋值到连接池
            self::$_connections[$instanceKey] = $connection;
        }

        # 返回实例
        return self::$_connections[$instanceKey];
    }

    /**
     * 生成实例key
     * @author liyw<2021-03-16>
     * @param array $options
     * @return string
     */
    private static function generateInstanceKey(array $options = []): string
    {
        return md5(serialize($options));
    }
}

# Simple-yaf Framework for PHP 

根据源生Yaf框架，封装的框架。

## 版本

#### Version 1.0.0
> 源生Yaf框架(使用yaf_cg生成)，未做任何修改。

#### Version 2.*
> 根据源生Yaf框架，进行了简单的封装，未引入composer包(引入composer，会影响框架性能，后续版本会引入)。数据库类包使用Medoo，日志使用Seaslog扩展。

## 要求
> 扩展安装请注意相对应的PHP版本要求，框架并未严格要求PHP版本，最低版本要求为PHP 7以上。
- PHP >= 7
- [Yaf](https://pecl.php.net/package/yaf) >= 3.2.5 扩展
- [Seaslog](https://pecl.php.net/package/seaslog) >= 2.* 扩展

## 安装

```bash
$ composer create-project weiyixmm/yaf simple-yaf [1.0.0]
```

## 目录结构(2.*)

```
├── application
│   ├── Bootstrap.php               # 引导文件
│   ├── cli                        
│   │   └── Demo.php                # Cli示例文件
│   ├── controllers               
│   │   ├── Error.php               # 全局错误收集
│   │   └── Index.php               # 默认控制器
│   ├── library                    
│   │   ├── BaseApi.php             # modules下Api基类
│   │   ├── core                   
│   │   │   ├── Request.php         # 请求处理
│   │   │   ├── Response.php        # 响应处理
│   │   │   └── ResponseStatus.php  # 状态码文件
│   │   ├── database
│   │   │   ├── BaseDB.php          # 数据库单例基类
│   │   │   └── Medoo.php           # 数据库操作类
│   │   ├── readme.txt
│   │   └── redis
│   │       └── Redis.php           # Redis操作类
│   ├── models
│   │   ├── Demo.php                # Model示例
│   │   └── Sample.php              # 原生Model
│   ├── modules                     # 模块
│   │   └── Api                     # Api模块(可以添加多个) 
│   │       ├── controllers
│   │       │   └── Demo.php        # 示例控制器
│   │       └── service
│   │           └── DemoService.php # 示例逻辑处理
│   ├── plugins
│   │   ├── Common.php              # 通用中间件
│   │   └── Sample.php              # 原生中间件
│   └── views
│       ├── error
│       │   └── error.phtml
│       └── index
│           └── index.phtml
├── composer.json
├── conf
│   └── application.ini             # 配置文件
├── public
│   ├── cli.php                     # cli入口文件
│   └── index.php                   # 入口文件
└── readme.md
```

## 使用
框架内有使用示例，关于Yaf框架，请参照[Yaf 手册](https://www.laruence.com/manual/index.html)

# 项目开发文档

## 安装
```
// 安装依赖包
composer install

// 复制一份环境变量的文件
cp .env.example .env

// 创建laravel秘钥
php artisan key:generate

// 创建JWT秘钥
php artisan jwt:secret

// 创建文件上传软链接
php artisan upload:link

// 执行数据迁移文件
php artisan migrate
```

## 前端开发人员需要阅读的文档
* [RESTFULL API文档](./Docs/rest_api.md)
* [WEB开发文档](./Docs/web_developer.md)

## 后端开发人员需要阅读的文档
* [RESTFULL API文档](./Docs/rest_api.md)
* [PHP开发文档](./Docs/php_developer.md)

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

// 【临时】复制一份前端的环境配置文件
cp resources/vue/utils/env.js.example resources/vue/utils/env.js

// 安装前端依赖
yarn

// 编译前端资源
yarn dev
```

## 前端开发人员需要阅读的文档
* [RESTFULL API文档](./Docs/rest_api.md)
* [WEB开发文档](./Docs/web_developer.md)

## 后端开发人员需要阅读的文档
* [RESTFULL API文档](./Docs/rest_api.md)
* [PHP开发文档](./Docs/php_developer.md)
* [SwaggerAPI文档开发指南](./Docs/OpenAPI.md)

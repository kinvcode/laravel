# 项目开发文档

使用本项目前假设你已熟悉[laravel6文档](https://laravel.com/docs/6.x)

## 开发环境以及其他要求

* VirtualBox + vagrant
* vagrant box v9.0.0
* homestead v7.8.0
* php 7.3+
* js包管理 yarn

## 【前端】工作目录

```
resources
└───vue
│   │   main.js    // 主入口
|   |   routers.js  // 所有路由
│   │
│   |____assets    // css、image、svg等资源
│   |   |____css   // 所有sass资源
|   |   |    |  reset.scss       // 兼容各浏览器
|   |   |    |  global.scss      // 全局css
|   |   |    |  variable.scss    // sass变量和function等
│   |   |____img   // image图标库
|   |   |____svg   // svg图标库
|   |
|   |____components    // 组件
│   |   |____common    // common自注册组件
│   |        |____base // 原子组件(如果是引入第三方，该文件夹可省略)
│   |        |   ...   // 业务公用组件
│   |   |____entity    // entity页面组件
│   |   |____about     // about页面组件
|   |
|   |____pages     // UI层(原则：轻page，重component)
|   |   |____entity
|   |   |    |  list.vue      // 列表页
|   |   |    |  create.vue    // 新增页
|   |   |    |  edit.vue      // 修改页
|   |   | main.vue
|   |
|   |____plugins   // 自己或第三方插件
|   |   | index.js       // 插件入口文件
|   |   | directives.js  // 所有Vue指令
|   |   | filters.js  // 所有Vue过滤
|   |
|   |____server    // 接口层
|   |   | index.js   // 所有接口
|   |   | http.js  // axios二次封装
|   |
|   |____store     // vuex数据
|   |   | index.js
|   |
|   |____utils     // 工具层
|   |   | config.js// 配置文件，包括常量配置
│
│
```

## API
* Api认证统一使用 bear_token
* 数据返回格式统一使用 json
* 需要授权的 Api，需要加 Bearer 的 Header
* Api 里面的通配符，:id 代表纯数字， :name 代表由数字+字母+[-_.]这些特殊字符
* 使用 HTTP Status Code 表示状态
* 时间格式：yyyy-MM-dd HH:mm:ss, 如”2007-06-28 11:16:11”

### ⽤ HTTP 动词描述操作
>常⽤的动词及幂等性

动词 | 描述 | 是否幂等
--- | --- | ---
GET | 获取资源，单个或多个 | 是
POST | 创建资源 | 否
PUT | 更新资源，客⼾端提供完整的资源数据 | 是
PATCH | 更新资源，客⼾端提供部分的资源数据 | 否
DELETE | 删除资源 | 是


### 返回状态说明
状态码 | 含义 | 说明
--- | --- | ---
200 | OK | 	请求成功
201 | CREATED | 创建成功
204 | No Content | 对不会返回响应体的成功请求进⾏响应（⽐如 DELETE 请求）
400 | BAD REQUEST | 请求异常
401 | UNAUTHORIZED | 未授权
403 | FORBIDDEN | 被禁止访问
404 | NOT FOUND | 请求的资源不存在
405 | Method Not Allowed | 所请求的 HTTP ⽅法不允许当前认证⽤⼾访问
422 | Unprocessable Entity | ⽤来表⽰校验错误 
429 | Too Many Requests | 由于请求频次达到上限⽽被拒绝访问
500 | INTERNAL SERVER ERROR | 内部错误
503 | Service unavailable | 服务器维护状态

### 访问限制信息
>为了防⽌服务器被攻击，减少服务器压⼒，需要对接⼝进⾏合适的限流控制，需要在响应头信息中加⼊ 合适的信息，告知客⼾端当前的限流情况

Header名称 | 含义
--- | ---
X-RateLimit-Limit | 每分钟请求次数
X-RateLimit-Remaining | 每分钟剩余次数

### 数据响应格式
>默认使⽤ JSON 作为数据响应格式。

#### 错误响应格式
>发生错误时，HTTP Status Code 为 400 错，如 400，403，404
```json
{
  "msg": "uri_not_found",
  "code": 1001,
  "request": "GET /v1/version"
}
```

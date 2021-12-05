[toc]
## REST API 设计规范

* Api认证统一使用 bear_token
* 数据返回格式统一使用 json
* 需要授权的 Api，需要加 Bearer 的 Header
* Api 里面的通配符，:id 代表纯数字， :name 代表由数字+字母+[-_.]这些特殊字符
* 使用 HTTP Status Code 表示状态
* 时间格式：yyyy-MM-dd HH:mm:ss, 如”2007-06-28 11:16:11”

### URI命名规范
* 规则1：URI结尾不应包含（/）
* 规则2：正斜杠分隔符（/）必须用来指示层级关系
* 规则3：应使用连字符（ - ）来提高URI的可读性
* 规则4：不得在URI中使用下划线（_）
* 规则5：URI路径中全都使用小写字母

### ⽤ HTTP 动词描述操作

> 常⽤的动词及幂等性

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
200 | OK |    请求成功
201 | CREATED | 创建成功
204 | No Content | 对不会返回响应体的成功请求进⾏响应（⽐如 DELETE 请求）
400 | BAD REQUEST | 请求异常
401 | Unauthorized | 未授权
403 | Forbidden | 被禁止访问
404 | Not Found | 请求的资源不存在
405 | Method Not Allowed | 所请求的 HTTP ⽅法不允许当前认证⽤⼾访问
415 | Unsupported Media Type | 如果请求中的内容类型是错误的(Content-Type)
422 | Unprocessable Entity | ⽤来表⽰校验错误
429 | Too Many Requests | 由于请求频次达到上限⽽被拒绝访问
500 | Server Error | 服务器错误
503 | Service unavailable | 服务器维护状态

### 全局错误码
> 全局响应即访问任意API都可能会返回的响应体

错误码 | 错误信息 | 含义 | status code
--- | --- | --- | ---
40001 | Unauthorized | 未授权 | 401
40003 | Forbidden | 访问被拒绝 | 403
40004 | Not Found | 资源不存在 | 404
40005 | Method Not Allowed | 请求方法不允许 | 405
40022 | *** | 参数校验错误 | 422
50000 | Server Error | 服务器内部错误 | 500
以下为拓展 |
xxx | xxx | xxx | xxx

### 局部响应码
> 局部响应指具体的API，比如登录接口，注册接口。

局部响应不在此规范中声明，应当在具体项目的API文档（swagger）中给出具体解释

#### 关于需要反馈结果的API响应体结构
>此响应体结构仅供参考，具体做法应当根据实际业务做调整
登录失败
```json
{
  "status": -1,
  "message": "Email and password do not match.",
  "request": "POST /api/v1/auth/login"
}
```

### 访问限制信息

> 为了防⽌服务器被攻击，减少服务器压⼒，需要对接⼝进⾏合适的限流控制，需要在响应头信息中加⼊ 合适的信息，告知客⼾端当前的限流情况

Header名称 | 含义
--- | ---
X-RateLimit-Limit | 每分钟请求次数
X-RateLimit-Remaining | 每分钟剩余次数

### 数据响应格式

> 默认使⽤ JSON 作为数据响应格式。

#### 错误统一响应格式

> 发生错误时，HTTP Status Code 为 400 错，如 401，404，422等

```json
{
  "msg": "Unauthorized",
  "code": 40001,
  "request": "GET /api/v1/me"
}
```

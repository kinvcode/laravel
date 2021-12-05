# 前端团队开发规范
## 前端团队规范总结
团队规范对于团队合作非常重要，大大减少项目之间的沟通，提高整体解决方案。有些规范能让lint做强制审核的，尽量用lint；有些需要约定俗成的，则记录成文档形成规范。

## 工程化
### 脚手架
* vue
* vue-router
* vue-i18n
* vuex
* axios
* sass
* element-ui


### 工具
* eslint

## 规范
### AI前端JS规范
### AI前端CSS规范
### AI前端Vue规范


## 【前端】工作目录

```
resources
└───vue
│   │   main.js    // 主入口
|   |   routers.js  // 所有路由
│   │
│   |____assets    // css、image、svg等资源
│   |   |____css   // 所有sass资源
|   |   |    |  global.scss      // 全局css
|   |   |    |  variable.scss    // sass变量和function等
|   |   |    |__pages            // 页面css
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
|   |____lang     // 多语言
|   |   | globals.json  // 全局多语言
|   |   | home.json     // 页面多语言
|   |
|   |____pages     // UI层(原则：轻page，重component)
|   |   | home.vue
|   |   | User.vue
|   |
|   |____plugins   // 自己或第三方插件
|   |
|   |____server    // 接口层
|   |   | index.js   // 所有接口
|   |   | http.js    // axios二次封装
|   |
|   |____store     // vuex数据
|   |   | index.js
|   |
|   |____utils     // 工具层
|   |   | config.js // 配置文件，包括常量配置
|   |   | env.js    // 环境变量配置【暂时代替】
│
│
```

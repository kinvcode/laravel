import Vue                from "vue";
import axios              from 'axios'
import {Message, Loading} from 'element-ui'
import {API_URL}          from "../utils/env";

const service = axios.create({
  baseURL: API_URL,
  timeout: 15000
})

let loading = null;
let locale = sessionStorage.getItem('locale') || 'en'
let token = sessionStorage.getItem('bearer_token') || null;

// request拦截器
service.interceptors.request.use(
  config => {
    // 默认
    config.headers['Content-Type'] = 'application/json'

    // 序列化
    config.data = JSON.stringify(config.data)

    // 上传文件
    if (config.type === 'form') {
      config.headers['Content-Type'] = 'multipart/form-data'
    }

    // 配置token
    if (token) {
      config.headers['Authorization'] = 'Bearer ' + token
    }

    // 配置lang
    config.headers['Accept-Language'] = locale

    // 加载动画
    loading = Loading.service({
      lock: true,
      text: 'loading',
      spinner: 'el-icon-loading',
      background: 'rgba(0, 0, 0, 0.7)'
    });
    return config
  },
  error => {
    Promise.reject(error)
  }
)

// response拦截器
service.interceptors.response.use(
  response => {
    console.log('response:', response);
    // 取消加载动画
    loading.close();

    // 获取API返回数据
    const data = response.data

    return Promise.reject(data)
  },
  error => {
    // 取消加载动画
    loading.close();
    console.log('error:', error);
    let status = error.response.status;
    switch (status) {
      case 401:
        // 跳转到login界面
        break;
      case 422:
        // 处理参数验证失败
        break;
      case 429:
        // 处理请求频繁
        Message.info('The operation is too frequent,please try again later.');
        break;
      case 403:
        // 处理访问被拒绝
        break;
      case 404:
        // 处理资源未找到
        Message.info('Not found.');
        break;
      case 415:
        // 处理请求类型错误
        break;
      case 500:
      default:
        // 处理服务器错误或其他错误
        Message.error('unknown error.');
        break;
    }
    return Promise.reject(error)
  }
)

export default service

<i18n src="../lang/Home.json"></i18n>
<template>
  <div class="hello">
    <h1>首页</h1>
    <p>message: {{ $t('hello') }}</p>
    <el-row>
      <el-button type="info" @click="init">获取版本信息</el-button>
      <el-button type="primary" @click="login">登录</el-button>
      <el-button type="success" @click="getMeInfo">获取我的信息</el-button>
    </el-row>
    <div>当前版本：{{ version }}</div>
    <div class="foo">自定义字体文件</div>
    <video controls style="width: 20%;" src="@/assets/audio/logo_animation.mp4"></video>
    <img src="@/assets/images/primary.png" alt="">
    <img src="@/assets/images/ext/primary.png" alt="">
  </div>
</template>


<script>
import {getVersion, login, getMe} from "../server";

export default {
  name: 'HomePage',
  data () {
    return {
      version: null,
      // img: image,
      video: testVideo
    }
  },
  methods: {
    init () {
      getVersion().then((response) => {
        this.version = response.version;
      })
    },
    login () {
      login({
        email: '396981577@qq.com',
        password: '123456qqWW'
      }).then((response) => {
        sessionStorage.setItem('token', response.access_token);
      }).catch((error) => {
        console.log(error);
      })
    },
    getMeInfo () {
      getMe().then((response) => {
        console.log(response);
      }).catch((error) => {
        console.log(error);
      })
    }
  },
  created () {
    this.init();
  },
  mounted () {

  }
}
</script>

<style lang="scss" scoped>
@import "../assets/css/global.scss";

.foo {
  font-family: GenSenMaruGothicTW-Bold;
}
</style>

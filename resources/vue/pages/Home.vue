<template>
  <div class="hello">
    <h1>首页</h1>
  </div>
</template>

<script>
import {getVersion}      from "../server";
import {Loading, Button} from 'element-ui';

// const i18n = new VueI18n({
//   locale: sessionStorage.getItem('locale') || 'en',
//   messages
// })

export default {
  name: 'Home',
  components: {
    Loading,
    'el-button': Button,
  },
  data () {
    return {
      version: null,
    }
  },
  methods: {
    init () {
      getVersion().then(response => {
        console.log(response);
      }).catch(error => {
        console.log(error);
      });
    },
  },
  created () {
    this.init();
  }
}
</script>

<style lang="scss" scoped>
@import "../assets/css/global.scss";
</style>

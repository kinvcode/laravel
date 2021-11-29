<i18n src="../lang/Home.json"></i18n>
<template>
  <div class="hello">
    <h1>首页</h1>
    <p>message: {{ $t('hello') }}</p>
  </div>
</template>


<script>
import {getVersion}      from "../server";
import {Loading, Button} from 'element-ui';

export default {
    name: 'Home',
    components: {
        'el-button': Button,
    },
    data() {
        return {
            version: null,
        }
    },
    methods: {
        init() {
            getVersion().then(response => {
                console.log(response);
            }).catch(error => {
                console.log(error);
            });
        },
    },
    created() {
        this.init();
    }
}
</script>

<style lang="scss" scoped>
@import "../assets/css/global.scss";
</style>

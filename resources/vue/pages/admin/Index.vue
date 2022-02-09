<template>
  <div class="hello">
    <h1>后台</h1>
      <el-button type="success" @click="jumpHome">返回首页</el-button>
  </div>
</template>

<script>
export default {
    name: 'AdminPage',
    methods:{
        jumpHome(){
            this.$router.push({path:'/'});
        },
    }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
h1 {
  margin: 40px 0 0;
}
</style>

<template>
  <RouterView />
</template>
<style>
h1{
  font-size: 100px;
}
* {
  background-color: #ffde59;
  
  font-size: 30px;
}


</style>
<script>
import VueCookie from 'vue-cookie'
export default {
  mounted() {
    this.getUserData()
  },
  methods: {
    getUserData() {
      let storedData = VueCookie.get('TUTogetherUserData')
      if (!storedData) {
        alert('login!')
        this.$router.push('/login')
      }
    }
  }
}
</script>

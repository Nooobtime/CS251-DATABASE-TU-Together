<template>
  <RouterView />
</template>
<style>
*{
  background-color: #FFDE59;
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
      // Get the userData cookie
      let storedData = VueCookie.get('TUTogetherUserData')
      if (!storedData) {
        alert("login!")
        this.$router.push('/login');
      }
    }
  }
}
</script>
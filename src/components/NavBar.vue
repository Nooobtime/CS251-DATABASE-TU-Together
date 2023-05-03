<template>
  <nav>
    <div><router-link to="/">Home</router-link></div>
    <div><router-link to="/poll">Poll</router-link></div>
    <div><router-link to="/">Edit</router-link></div>
    <div><button @click="logout">Logout</button></div>
  </nav>
</template>
<script>
import VueCookie from 'vue-cookie'
export default {
  methods: {
    logout() {
      //click logout buttom to logout 
      VueCookie.delete('TUTogetherUserData')
      this.$router.push('/login')
      this.$forceUpdate()
    }
  }
}
</script>

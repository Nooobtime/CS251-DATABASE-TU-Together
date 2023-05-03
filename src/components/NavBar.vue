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
import Logout from '../assets/js/logout.js'

export default {
  methods: {
    logout() {
      Logout.logout(this, VueCookie)
    }
  }
}
</script>

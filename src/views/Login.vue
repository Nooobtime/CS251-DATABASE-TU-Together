<template>
  <div>
    <h1>Login</h1>
    <form @submit.prevent="login">
      <div>
        <label for="username">Username:</label>
        <input type="text" id="username" v-model="username" required />
      </div>
      <div>
        <label for="password">Password:</label>
        <input type="text" id="password" v-model="password" required />
      </div>
      <div>
        <button type="submit">Login</button>
      </div>
    </form>
    <p v-if="error" style="color: red">{{ error }}</p>
  </div>
</template>
<style scoped src="../assets/css/login.css"></style>

<script>
import axios from 'axios'
import VueCookie from 'vue-cookie'
import loginMethods from '../assets/js/login.js'

export default {
  data() {
    return {
      username: '',
      password: '',
      error: ''
    }
  },
  mounted() {
    loginMethods.getUserData(this)
  },
  methods: {
    login() {
      loginMethods.login(this, axios, VueCookie)
    }
  }
}
</script>

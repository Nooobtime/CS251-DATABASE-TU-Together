
<template>
  <div>
    <img src="../assets/img/logo/TU_logo.png" style="height: 100px; width: 100px" />
  </div>
  <div class="login">
    <h1>Login Page</h1>
    <form class="column" @submit.prevent="login">
      <label>Username</label>
      <input
        type="text"
        id="username"
        placeholder="เลขทะเบียนนักศึกษา/รหัสผู้ใช้"
        v-model="username"
        required
      />
      <label>Password</label>
      <input type="text" id="password" placeholder="รหัสผ่าน" v-model="password" required />
      <button type="submit">Sign in</button>
    </form>
  </div>
</template>

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

<style>
.login {
  max-width: 400px;
  margin: auto;
  padding: 20px;
  border: 1px solid #ccc;
  border-radius: 5px;
}
.login h1 {
  text-align: center;
  margin-bottom: 20px;
}
.login form {
  display: flex;
  flex-direction: column;
}
.login label {
  font-weight: bold;
  margin-bottom: 10px;
}
.login input {
  padding: 10px;
  margin-bottom: 20px;
  border-radius: 5px;
  border: 1px solid #ccc;
}
.login button {
  padding: 10px;
  border-radius: 5px;
  border: none;
  background-color: #007bff;
  color: #fff;
  cursor: pointer;
}
</style>

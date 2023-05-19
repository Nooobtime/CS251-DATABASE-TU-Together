<template>
  <div class="login">
    <div id="text">
      <img src="../assets/img/logo/TU_logo.png" style="height: 100px; width: 100px" />
      <h1>WELCOME<br />TU Tugether</h1>
    </div>
    <form class="column" @submit.prevent="login">
      <input
        type="text"
        id="username"
        placeholder="student id/user id"
        v-model="username"
        required
      />
      <input type="text" id="password" placeholder="password" v-model="password" required />
      <button id="login" type="submit">login</button>
      <div>
        <p v-if="error" style="color: red">{{ error }}</p>
      </div>
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
  margin-top: 100px;
  padding-top: 20px;
  padding-bottom: 20px;
  padding-left: 40px;
  padding-right: 40px;
  border: 1px solid #ccc;
  border-radius: 25px;
  background-color: rgb(255, 255, 255, 0.5);
  color: black;
}
.login h1 {
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
  border-radius: 25px;
  border: 1px solid #ccc;
}
.login button {
  padding: 10px;
  border-radius: 25px;
  border: none;
  background-color: #ffb048;
  cursor: pointer;
}
#text {
  text-align: center;
  text-align: center;
}
input:focus {
  outline: none;
}
img {
  margin-top: 10px;
}
</style>

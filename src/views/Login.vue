<template>
  <div class="container">
    <div class="row">
      <div class="col container">
        <div>
          <img src="../assets/img/logo/TU_logo.png" style="width: 40%" />
          <span>welcome</span>
          <h1>TU together</h1>
        </div>
      </div>
      <div class="col container">
        <div class="">
          <form @submit.prevent="login">
            <div class="form-outline mb-4">
              <label class="form-label" for="username">Username</label>
              <input type="text" class="form-control" id="username" v-model="username" required />
            </div>
            <div class="form-outline mb-4">
              <label class="form-label" for="password">Password</label>
              <input type="text" class="form-control" id="password" v-model="password" required />
            </div>
            <button type="submit" class="btn btn-primary btn-block mb-4">Sign in</button>
            <p v-if="error" style="color: red">{{ error }}</p>
          </form>
        </div>
      </div>
    </div>
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

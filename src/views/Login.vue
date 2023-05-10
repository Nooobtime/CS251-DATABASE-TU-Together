<template>
  <div  style="">
    <div  >
      <div >
        <div>
          <img src="../assets/img/logo/TU_logo.png"/>
          <span>welcome</span>
          <h1>TU together</h1>
        </div>
      </div>
      <div >
        <div >
          <form @submit.prevent="login" >
            <div>เข้าสู่ระบบ (นักศึกษา/บุคลากร)</div>
            <div >
              <label  for="username">Username</label>
              <input type="text" id="username" placeholder="เลขทะเบียนนักศึกษา/รหัสผู้ใช้" v-model="username" required/>
            </div>
            <div >
              <label  for="password">Password</label>
              <input type="text"  id="password" placeholder="รหัสผ่าน" v-model="password" required />
            </div>
            <button type="submit">Sign in</button>
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

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
export default {
  data() {
    return {
      username: '',
      password: '',
      error: ''
    }
  },
  methods: {
    login() {
      axios
        .post(
          'https://restapi.tu.ac.th/api/v1/auth/Ad/verify2',
          {
            UserName: this.username,
            PassWord: this.password
          },
          {
            headers: {
              'Content-Type': 'application/json',
              'Application-Key':
                'TUdf7e79f1e0c5d3c9b2ec2f0e3a020b3304e430a0d5da9bb391acf6266e2c8fc3609c8ae07c5c9ea42e487b8eeb1af452'
            }
          }
        )
        .then((response) => {
          let data = response.data
          VueCookie.set('TUTogetherUserData', data, { expires: '1d' })
          this.$router.push('/')
          console.log(data)
        })
        .catch((error) => {
          console.error(error)
          this.error = error.response.data.message
        })
    }
  }
}
</script>

<template>
  <div class="login">
    <div id="text">
      <img
        src="../assets/logo/TU_logo.png"
        style="height: 100px; width: 100px"
      />
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
      <input
        type="text"
        id="password"
        placeholder="password"
        v-model="password"
        required
      />
      <button id="login" type="submit">login</button>
      <div>
        <p v-if="error" style="color: red">{{ error }}</p>
      </div>
    </form>
  </div>
</template>

<script>
import axios from "axios";
import VueCookie from "vue-cookie";

export default {
  data() {
    return {
      username: "",
      password: "",
      error: "",
    };
  },
  mounted() {
    this.getUserData();
  },
  methods: {
    login() {
      axios
        .post(
          "https://restapi.tu.ac.th/api/v1/auth/Ad/verify2",
          {
            UserName: this.username,
            PassWord: this.password,
          },
          {
            headers: {
              "Content-Type": "application/json",
              "Application-Key":
                "TUdf7e79f1e0c5d3c9b2ec2f0e3a020b3304e430a0d5da9bb391acf6266e2c8fc3609c8ae07c5c9ea42e487b8eeb1af452",
            },
          }
        )
        .then((response) => {
          let data = response.data;
          VueCookie.set("TUTogetherUserData", data, { expires: "1d" });
          this.$router.push("/");
          console.log(data);
        })
        .catch((error) => {
          console.error(error);
          this.error = error.response.data.message;
        });
    },
    getUserData() {
      // Get the userData cookie
      let storedData = VueCookie.get("TUTogetherUserData");
      if (storedData) {
        alert("already login");
        this.$router.push("/");
      }
    },
  },
};
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
  background-color: rgba(255, 255, 255, 0.5);
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
}
input:focus {
  outline: none;
}
img {
  margin-top: 10px;
}
</style>

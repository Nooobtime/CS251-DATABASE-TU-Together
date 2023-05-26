<template>
  <div class="flex min-h-full flex-1 flex-col justify-center items-center px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
      <img class="mx-auto h-20 w-auto" src="../assets/logo/TU_logo.png" alt="Your Company" />
      <h1 class="mt-6 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">
        TU Together
      </h1>
    </div>
    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
      <form class="space-y-6" @submit.prevent="login">
        <div>
          <div class="mt-2">
            <input
              type="text"
              id="username"
              placeholder="student id/user id"
              v-model="username"
              required
              class="px-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
            />
          </div>
        </div>

        <div>
          <div class="flex items-center justify-between"></div>
          <div class="mt-2">
            <input
              type="password"
              id="password"
              placeholder="password"
              v-model="password"
              required
              class="px-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
            />
          </div>
        </div>

        <div>
          <button
            id="login"
            type="submit"
            class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
          >
            Sign in
          </button>
        </div>
        <div>
          <p v-if="error" style="color: red">{{ error }}</p>
        </div>
      </form>
    </div>
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
          let userData = response.data;
          VueCookie.set("TUTogetherUserData", userData, { expires: "1d" });
          this.$router.push("/");
          console.log(userData);
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

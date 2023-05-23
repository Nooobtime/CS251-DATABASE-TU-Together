<template>
  <nav class="fixed top-0 left-0 w-full bg-white border-gray-200 z-50">
    <div
      class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4"
    >
      <a class="flex items-center">
        <router-link to="/">
          <img
            src="../assets/logo/TU_logo.png"
            class="h-8 mr-3"
            alt="Flowbite Logo"
        /></router-link>
        <router-link to="/"
          ><span class="self-center text-2xl font-semibold whitespace-nowrap"
            >TU Together</span
          ></router-link
        >
      </a>
      <button
        id="menuButton"
        data-collapse-toggle="navbar-default"
        type="button"
        class="inline-flex items-center p-2 ml-3 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
        aria-controls="navbar-default"
        aria-expanded="false"
        @click="toggleMenu"
      >
        <span class="sr-only">Open main menu</span>
        <svg
          class="w-6 h-6"
          aria-hidden="true"
          fill="currentColor"
          viewBox="0 0 20 20"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            fill-rule="evenodd"
            d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
            clip-rule="evenodd"
          ></path>
        </svg>
      </button>
      <div
        class="hidden w-full md:block md:w-auto"
        :class="{ block: isMenuOpen, hidden: !isMenuOpen }"
      >
        <ul
          class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 md:mt-0 md:border-0 md:bg-white"
        >
          <li>
            <router-link
              class="block py-2 pl-3 pr-4 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0"
              aria-current="page"
              to="/"
            >
              Home
            </router-link>
          </li>
          <li>
            <router-link
              class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0"
              to="/polllist"
            >
              Poll
            </router-link>
          </li>
          <li>
            <button
              class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0"
              @click="logout"
            >
              Logout
            </button>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="pb-24"></div>
</template>

<script>
import VueCookie from "vue-cookie";

export default {
  methods: {
    logout() {
      VueCookie.delete("TUTogetherUserData");
      this.$router.push("/login");
    },
    toggleMenu() {
      this.isMenuOpen = !this.isMenuOpen;
    },
  },
  data() {
    return {
      isMenuOpen: false,
    };
  },
};
</script>

<template>
  <NavBar />
  <div class="container flex justify-center items-center h-screen">
    <div>
      <span class="text-5xl font-bold text-gray-800 text-center mb-8"
        >404 Not Found</span
      >
      <span class="countdown text-2xl text-gray-500">
        Redirecting
        <br />
        {{ countdown }}
        seconds...
      </span>
    </div>
  </div>
  <Footer/>
</template>

<script>
import redirectScript from "../assets/js/redirect.js";
export default {
  mixins: [redirectScript],
};
</script>

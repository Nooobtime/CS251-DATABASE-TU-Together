<template>
  <div class="container flex justify-center items-center h-screen">
    <div>
      <span class="text-5xl font-bold text-gray-800 text-center mb-8"
        >404 Not Found</span
      >
      <span class="countdown text-2xl text-gray-500">
        Redirecting
        <br />{{ countdown }} seconds...
      </span>
    </div>
  </div>
  <div class="flex justify-center items-center">
    <div class="w-12 h-12 relative">
      <div
        class="circle circle-1 border-transparent border-2/10 border-solid border-red-500 animate-spin"
      ></div>
      <div
        class="circle circle-2 border-transparent border-2/10 border-solid border-red-500 animate-ping"
      ></div>
    </div>
  </div>
</template>

<script>
import redirectScript from "../assets/js/redirect.js";
export default {
  mixins: [redirectScript],
};
</script>

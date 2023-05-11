<template>
  <div class="container">
    <div>
      <span>404 Not Found</span>
      <br />
      <span class="countdown">Redirecting in {{ countdown }} seconds...</span>
    </div>
  </div>
</template>

<style>
.container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
}

span {
  font-size: 5rem;
  font-weight: bold;
  color: #333;
  text-align: center;
  display: block;
  margin-bottom: 2rem;
}

.countdown {
  font-size: 2rem;
  color: #555;
}
</style>

<script>
import redirectScript from '../assets/js/redirect.js'
export default {
  mixins: [redirectScript]
}
</script>

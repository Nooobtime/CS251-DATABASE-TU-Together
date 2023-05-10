<template>
  <div>
    <div>
      <span>
        404 Not Found
        <br />
        Redirecting in {{ countdown }} seconds...
      </span>
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
  font-size: 100px;
}
</style>
<script>
import redirectScript from '../assets/js/redirect.js'
export default {
  mixins: [redirectScript]
}
</script>

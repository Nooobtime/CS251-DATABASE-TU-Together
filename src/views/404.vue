<template>
  <div class="container">
    <div class="centered-element">
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
export default {
  data() {
    return {
      // set the initial countdown value to 5
      countdown: 5 
    }
  },
  mounted() {
    setInterval(() => {
      if (this.countdown > 1) {
        this.countdown--
      } else {
        // redirect to another page after the countdown finishes
        this.$router.push('/')
      }
    }, 1000)
  }
}
</script>

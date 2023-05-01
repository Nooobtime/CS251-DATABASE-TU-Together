<template>
  <div class="container">
    <div class="centered-element">
        <span>
            404 Not Found
            <br>
            Redirecting to Home page
            <br>
            in {{countdown}} seconds...
        </span>
    </div>
  </div>
</template>
<style>
.container {
  display: flex;
  justify-content: center; /* center horizontally */
  align-items: center; /* center vertically */
  height: 100vh; /* set the height of the container to the height of the viewport */
  
}
span{
    font-size: 100px;
}
</style>
<script>
export default {
  data() {
    return {
      countdown: 5, // set the initial countdown value to 5
    };
  },
  mounted() {
    // start the countdown timer when the component is mounted
    setInterval(() => {
      if (this.countdown > 1) {
        this.countdown--;
      } else {
        // redirect to another page after the countdown finishes
        this.$router.push('/');
      }
    }, 1000);
  },
};
</script>
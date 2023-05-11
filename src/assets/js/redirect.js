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

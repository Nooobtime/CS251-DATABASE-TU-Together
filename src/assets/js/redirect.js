export default {
  data() {
    return {
      countdown: 5,
    };
  },
  mounted() {
    setInterval(() => {
      if (this.countdown > 1) {
        this.countdown--;
      } else {
        // redirect to another page after the countdown finishes
        this.$router.push("/");
      }
    }, 1000);
  },
};

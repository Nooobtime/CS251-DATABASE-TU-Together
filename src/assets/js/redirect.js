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
        this.$router.push("/");
      }
    }, 1000);
  },
};

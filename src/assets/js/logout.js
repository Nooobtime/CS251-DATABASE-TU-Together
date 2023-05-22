export default {
  logout(vm, VueCookie) {
    VueCookie.delete("TUTogetherUserData");
    vm.$router.push("/login");
    vm.$forceUpdate();
  },
};

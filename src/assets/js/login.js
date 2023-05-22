import VueCookie from "vue-cookie";
export default {
  login(vm, axios, VueCookie) {
    axios
      .post(
        "https://restapi.tu.ac.th/api/v1/auth/Ad/verify2",
        {
          UserName: vm.username,
          PassWord: vm.password,
        },
        {
          headers: {
            "Content-Type": "application/json",
            "Application-Key":
              "TUdf7e79f1e0c5d3c9b2ec2f0e3a020b3304e430a0d5da9bb391acf6266e2c8fc3609c8ae07c5c9ea42e487b8eeb1af452",
          },
        }
      )
      .then((response) => {
        let data = response.data;
        VueCookie.set("TUTogetherUserData", data, { expires: "1d" });
        vm.$router.push("/");
        console.log(data);
      })
      .catch((error) => {
        console.error(error);
        vm.error = error.response.data.message;
      });
  },
  getUserData(vm) {
    // Get the userData cookie
    let storedData = VueCookie.get("TUTogetherUserData");
    if (storedData) {
      alert("already login");
      vm.$router.push("/");
    }
  },
};

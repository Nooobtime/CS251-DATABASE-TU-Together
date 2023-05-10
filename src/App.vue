<template>
  <RouterView />
</template>
<script>
import VueCookie from 'vue-cookie'
export default {
  mounted() {
    this.getUserData()
  },
  methods: {
    getUserData() {
      let storedData = VueCookie.get('TUTogetherUserData')
      if (!storedData) {
        alert('login!')
        this.$router.push('/login')
      }
    }
  }
}
</script>

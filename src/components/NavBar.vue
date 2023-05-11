<template>
  <!-- Load an icon library to show a hamburger menu (bars) on small screens -->
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
  />

  <div class="topnav" id="myTopnav">
    <div class="logo">
      <img src="../assets/img/logo/TU_logo.png" style="height: 50px; width: 50px" />
    </div>
    <div id="router"><router-link to="/">home</router-link></div>
    <div id="router"><router-link to="/poll">poll</router-link></div>
    <div id="router"><router-link to="/">edit</router-link></div>
    <div class="icon" @click="myFunction()">
      <i id="icon" class="fa fa-bars"></i>
    </div>
    <div id="router"><button @click="logout()">log out</button></div>
  </div>
</template>
<style>
/* Add a black background color to the top navigation */
#router {
  padding: 30px 16px;
}
.topnav {
  background-color: #333;
  overflow: hidden;
}

/* Style the links inside the navigation bar */
.topnav div {
  float: left;
  display: block;
  color: #f2f2f2;
  text-align: center;
  padding: 20px 16px;
  text-decoration: none;
  font-size: 17px;
}

/* Change the color of links on hover */

/* Add an active class to highlight the current page */
.topnav div.active {
  background-color: #04aa6d;
  color: white;
}

/* Hide the link that should open and close the topnav on small screens */
.topnav .icon {
  display: none;
}
img {
  margin: 0px;
}
/* When the screen is less than 600 pixels wide, hide all links, except for the first one ("Home"). Show the link that contains should open and close the topnav (.icon) */
@media screen and (max-width: 600px) {
  .topnav div:not(:first-child) {
    display: none;
  }
  .topnav div.icon {
    padding: 32px 16px;
    float: right;
    display: block;
  }
  #router {
    padding: 10px 16px;
  }
}

/* The "responsive" class is added to the topnav with JavaScript when the user clicks on the icon. This class makes the topnav look good on small screens (display the links vertically instead of horizontally) */
@media screen and (max-width: 600px) {
  .topnav.responsive {
    position: relative;
  }
  .topnav.responsive div.icon {
    position: absolute;
    right: 0;
    top: 0;
  }
  .topnav.responsive div {
    float: none;
    display: block;
    text-align: left;
  }
  .logo {
    border-bottom: 1px solid black;
  }
}
</style>
<script>
import VueCookie from 'vue-cookie'
import Logout from '../assets/js/logout.js'

export default {
  methods: {
    logout() {
      Logout.logout(this, VueCookie)
    },
    /* Toggle between adding and removing the "responsive" class to topnav when the user clicks on the icon */
    myFunction() {
      var x = document.getElementById('myTopnav')
      var icon = document.getElementById('icon')
      if (x.className === 'topnav') {
        x.className += ' responsive'
        icon.className = 'fa-solid fa-xmark'
      } else {
        x.className = 'topnav'
        icon.className = 'fa fa-bars'
      }
    }
  }
}
</script>

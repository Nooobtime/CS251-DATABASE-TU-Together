<template>
    <div class="center">
      <img src="../assets/img/logo/TU_logo.png" />
      <br />
      <span>wellcome</span>
      <h1>TU together</h1>
    </div>
    <form>
      <div>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required />
        <br />
      </div>
      <div>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required />
        <br />
      </div>
      <div>
        <button type="submit">Log in</button>
      </div>
    </form>
  </template>
  <style>
  label,
  input {
    display: inline-block;
    vertical-align: middle;
  }
  div {
    text-align: center;
  }
  img {
    max-width: 10%;
  }
  </style>
  
<template>
  <div class="container">
    <div>
      <span>404 Not Found</span>
      <br />
      <span class="countdown">
        Redirecting
        <br />{{ countdown }} seconds...
      </span>
    </div>
  </div>
  <div class="half-circle-spinner">
    <div class="circle circle-1"></div>
    <div class="circle circle-2"></div>
  </div>
</template>

<style>
.half-circle-spinner,
.half-circle-spinner * {
  box-sizing: border-box;
}

.half-circle-spinner {
  width: 60px;
  height: 60px;
  border-radius: 100%;
  position: relative;
}

.half-circle-spinner .circle {
  content: '';
  position: absolute;
  width: 100%;
  height: 100%;
  border-radius: 100%;
  border: calc(60px / 10) solid transparent;
}

.half-circle-spinner .circle.circle-1 {
  border-top-color: #ff1d5e;
  animation: half-circle-spinner-animation 1s infinite;
}

.half-circle-spinner .circle.circle-2 {
  border-bottom-color: #ff1d5e;
  animation: half-circle-spinner-animation 1s infinite alternate;
}

@keyframes half-circle-spinner-animation {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}
.container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
}

span {
  font-size: 5rem;
  font-weight: bold;
  color: #333;
  text-align: center;
  display: block;
  margin-bottom: 2rem;
}

.countdown {
  font-size: 2rem;
  color: #555;
}
</style>

<script>
import redirectScript from '../assets/js/redirect.js'
export default {
  mixins: [redirectScript]
}
</script>

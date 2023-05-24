<template>
  <NavBar />
  <h1 class="text-center">รายชื่อ poll</h1>
  <div class="justify-items-end">
    <button class="mr-2">all poll</button>
    <button class="mr-2">my poll</button>
    <button>my poll</button>
  </div>
  <ul role="list" class="divide-y divide-gray-100 mx-4 md:mx-36">
    <li
      v-for="rival in side"
      :key="rival.info"
      class="flex justify-between gap-x-6 py-5"
    >
      <div class="flex gap-x-4">
        <div class="min-w-0 flex-auto">
          <p class="text-sm font-semibold leading-6 text-gray-900">
            {{ rival.info }}
          </p>
          <p class="mt-1 truncate text-xs leading-5 text-gray-500">
            {{ rival.info }}
          </p>
        </div>
      </div>
      <div class="hidden sm:flex sm:flex-col sm:items-end">
        <router-link to="/poll">
          <button
            type="button"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
          >
            check
          </button>
        </router-link>
      </div>
    </li>
  </ul>
  <Footer />
</template>
<script setup>
let side = [
  {
    name: "Poll Name 1",
    info: "ลายละเอียด 1",
  },
  {
    name: "Poll Name 2",
    info: "ลายละเอียด 2",
  },
];
function getid() {
  //get id from vue cookie
  //define side to below code
}
getid();
</script>

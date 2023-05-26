<template>
  <NavBar />
  <h1 class="text-center text-3xl">รายชื่อ poll</h1>
  <ul role="list" class="divide-y divide-gray-100 mx-4 md:mx-36">
    <li
      v-for="Poll in Polls"
      :key="Poll.id"
      class="flex justify-between gap-x-6 py-5"
    >
      <div class="flex gap-x-4">
        <div class="min-w-0 flex-auto">
          <p class="text-sm font-semibold leading-6 text-gray-900">
            {{ Poll.name }}
          </p>
          <p class="mt-1 truncate text-xs leading-5 text-gray-500">
            {{ Poll.info }}
          </p>
        </div>
      </div>
      <div class="hidden sm:flex sm:flex-col sm:items-end">
        <router-link to="/poll" @click="logPollId(Poll.id)">
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
import VueCookie from "vue-cookie";
import jsonData from '../backend/table/poll.json';
import { pollid } from '../backend/table/pollid';

let Polls = jsonData;

const logPollId = (pollId) => {
  window.pollid=pollId;
  console.log(window.pollid);
};
</script>

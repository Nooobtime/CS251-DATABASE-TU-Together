<template>
  <NavBar />
  <div class="container mx-auto py-8">
    <h1 class="text-3xl text-center font-bold mb-8">รายชื่อ Poll</h1>
    <ul class="space-y-4">
      <li v-for="poll in pollList" :key="poll.id">
        <div class="bg-white p-4 shadow-sm rounded-md">
          <div class="flex items-center justify-between mb-2">
            <h2 class="text-lg font-semibold">{{ poll.name }}</h2>
            <router-link to="/poll" @click="logPollId(poll.id)">
              <template v-if="isExpired(poll.startDate, poll.endDate)">
                <button class="px-4 py-2 text-white bg-blue-500 hover:bg-blue-600 rounded-md">
                  <span v-if="!isExpired(poll.endDate)">Vote</span>
                  <span v-else>View</span>
                </button>
              </template>
              <template v-else>
                <button class="px-4 py-2 text-white bg-gray-300 cursor-not-allowed rounded-md" disabled>
                  Not Open Yet
                </button>
              </template>
            </router-link>
          </div>
          <p class="text-sm text-gray-600">{{ poll.info }}</p>
          <div class="mt-2 text-xs text-gray-500">
            Start Date: {{ poll.startDate }} | End Date: {{ poll.endDate }}
          </div>
        </div>
      </li>
    </ul>
  </div>
  <Footer />
</template>

<script setup>
import VueCookie from "vue-cookie";
import pollData from "../backend/table/poll.json";
import { pollid } from "../backend/table/pollid";

let pollList = pollData;

const logPollId = (pollId) => {
  window.pollid = pollId;
  console.log(window.pollid);
};

const isExpired = (startDate, endDate) => {
  const now = new Date();
  const start = new Date(startDate);
  const end = new Date(endDate);
  return now < start || now > end;
};
</script>

<style>
.container {
  max-width: 600px;
}
</style>

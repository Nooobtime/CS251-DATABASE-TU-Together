<template>
  <NavBar />
  <div class="bg-white">
    <div>
      <!-- Product info -->
      <div
        class="mx-auto max-w-2xl px-4 pb-16 pt-10 sm:px-6 lg:grid lg:max-w-7xl lg:grid-cols-3 lg:grid-rows-[auto,auto,1fr] lg:gap-x-8 lg:px-8 lg:pb-24 lg:pt-16"
      >
        <div class="lg:col-span-2 lg:border-r lg:border-gray-200 lg:pr-8">
          <h1
            class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl"
          >
            {{ pollName }}
          </h1>
        </div>

        <!-- Options -->
        <div class="mt-4 lg:row-span-3 lg:mt-0">
          <h2 class="sr-only">Poll information</h2>
          <form class="mt-10">
            <!-- Sizes -->
            <div class="mt-10">
              <div class="flex items-center justify-between">
                <h3 class="text-sm font-medium text-gray-900">เลือก</h3>
              </div>

              <RadioGroup class="mt-4">
                <RadioGroupLabel class="sr-only">Choose a size</RadioGroupLabel>
                <div
                  class="grid grid-cols-4 gap-4 sm:grid-cols-8 lg:grid-cols-4"
                >
                  <RadioGroupOption
                    v-for="side in pollSides"
                    :key="side.name"
                    :value="side"
                    v-slot="{ active, checked }"
                  >
                    <div
                      :class="[
                        'cursor-pointer bg-white text-gray-900 shadow-sm',
                        active ? 'ring-2 ring-indigo-500' : '',
                        'group relative flex items-center justify-center rounded-md border py-3 px-4 text-sm font-medium uppercase hover:bg-gray-50 focus:outline-none sm:flex-1 sm:py-6',
                      ]"
                    >
                      <RadioGroupLabel as="span">{{ side.id }}</RadioGroupLabel>
                      <span
                        :class="[
                          active ? 'border' : 'border-2',
                          checked ? 'border-indigo-500' : 'border-transparent',
                          'pointer-events-none absolute -inset-px rounded-md',
                        ]"
                        aria-hidden="true"
                      ></span>
                    </div>
                  </RadioGroupOption>
                </div>
              </RadioGroup>
            </div>

            <!-- Vote Button (Conditional) -->
            <button
              v-if="isPollOpen"
              @click="vote"
              type="button"
              class="mt-10 flex w-full items-center justify-center rounded-md border border-transparent bg-indigo-600 px-8 py-3 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
            >
              Vote
            </button>
          </form>
        </div>

        <div
          class="py-10 lg:col-span-2 lg:col-start-1 lg:border-r lg:border-gray-200 lg:pb-16 lg:pr-8 lg:pt-6"
        >
          <!-- Description and details -->
          <div>
            <h3 class="sr-only">Description</h3>

            <div class="space-y-6">
              <p class="text-base text-gray-900">{{ pollDescription }}</p>
            </div>
          </div>

          <div class="mt-10">
            <h3 class="text-sm font-medium text-gray-900">ฝั่ง</h3>

            <div class="mt-4">
              <ul role="list" class="list-disc space-y-2 pl-4 text-sm">
                <li
                  v-for="side in pollSides"
                  :key="side.name"
                  :value="side"
                  class="text-gray-400"
                >
                  <span class="text-gray-600"
                    >{{ side.id }} {{ side.name }} Info:{{ side.info }}</span
                  >
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <Footer />
</template>

<script setup>
import VueCookie from "vue-cookie";
import { RadioGroup, RadioGroupLabel, RadioGroupOption } from "@headlessui/vue";

let cookiePollsString = VueCookie.get("cookiePolls");
let cookieSidesString = VueCookie.get("cookieSides");
let cookiePollIdString = VueCookie.get("cookiePollId");
let cookiePolls = cookiePollsString ? JSON.parse(cookiePollsString) : [];
let cookieSides = cookieSidesString ? JSON.parse(cookieSidesString) : [];
let cookiePollId = cookiePollIdString ? JSON.parse(cookiePollIdString) : [];
let pollId = cookiePollId;
let tempPollName = "no";
let tempPollDescription = "no";

for (let i = 0; i < cookiePolls.length; i++) {
  if (cookiePolls[i].id === pollId) {
    tempPollName = cookiePolls[i].name;
    tempPollDescription = cookiePolls[i].info;
  }
}

const pollName = tempPollName;
const pollDescription = tempPollDescription;
const pollSides = cookieSides.filter((item) => item.poll_id === pollId);
const pollStartDate = cookiePolls.find((poll) => poll.id === pollId)?.startDate;
const pollEndDate = cookiePolls.find((poll) => poll.id === pollId)?.endDate;

const isPollOpen = () => {
  const now = new Date();
  const startDate = new Date(pollStartDate);
  const endDate = new Date(pollEndDate);
  return now >= startDate && now <= endDate;
};

const vote = () => {
  const userDataString = VueCookie.get("TUTogetherUserData");
  let userData;
  let userid;
  try {
    userData = JSON.parse(userDataString);
    userid = userData.username;
  } catch (error) {
    console.error("Error parsing JSON:", error);
  }
  if (checkIfUserVoted(pollVotes, userid, pollId)) {
    alert("You have already voted for this poll.");
  } else {
    const selectedOption = pollSides.find((side) => side.checked);
    if (!selectedOption) {
      alert("Please select an option before voting.");
      return;
    }

    const sideId = selectedOption.id;
    const voteData = {
      user_id: userid,
      poll_id: pollId,
      side_id: sideId,
    };

    let cookieVotesString = VueCookie.get("cookieVotes");
    let cookieVotes = cookieVotesString ? JSON.parse(cookieVotesString) : [];
    cookieVotes.push(voteData);
    VueCookie.set("cookieVotes", JSON.stringify(cookieVotes), {
      expires: "1d",
    });

    alert("Vote submitted!");
  }
};

const pollVotes = VueCookie.get("cookieVotes")
  ? JSON.parse(VueCookie.get("cookieVotes"))
  : [];

function checkIfUserVoted(pollVotes, userId, pollId) {
  for (let i = 0; i < pollVotes.length; i++) {
    if (pollVotes[i].user_id === userId && pollVotes[i].poll_id === pollId) {
      return true; // User has voted in the poll
    }
  }
  return false; // User has not voted in the poll
}
</script>

<style>
.container {
  max-width: 600px;
}
</style>

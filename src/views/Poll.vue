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
                      @click="selectedSide = side.id"
                    >
                      <RadioGroupLabel as="span">{{ side.id }}</RadioGroupLabel>
                      <span
                        :class="[
                          'border-2',
                          active ? 'border-indigo-500' : 'border-transparent',
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

const selectedSide = 1;
const cookiePolls = JSON.parse(VueCookie.get("cookiePolls") ?? "[]");
const cookieSides = JSON.parse(VueCookie.get("cookieSides") ?? "[]");
const cookiePollId = JSON.parse(VueCookie.get("cookiePollId") ?? "[]");
const cookieVotes = JSON.parse(VueCookie.get("cookieVotes") ?? "[]");

const { name: pollName, info: pollDescription } = cookiePolls.find(
  (poll) => poll.id === cookiePollId
) || { name: "no", info: "no" };

const pollSides = cookieSides.filter((item) => item.poll_id === cookiePollId);
const pollStartDate = cookiePolls.find(
  (poll) => poll.id === cookiePollId
)?.startDate;
const pollEndDate = cookiePolls.find(
  (poll) => poll.id === cookiePollId
)?.endDate;

const now = new Date();
const startDate = new Date(pollStartDate);
const endDate = new Date(pollEndDate);

const isPollOpen = now >= startDate && now <= endDate;

const vote = () => {
  const userId = VueCookie.get("username")?.toString() ?? "";
  const userAlreadyVoted = cookieVotes.some(
    (vote) => vote.user_id === userId && vote.poll_id === cookiePollId
  );

  if (userAlreadyVoted) {
    alert("You already voted!");
  }

  if (!userAlreadyVoted) {
    const newVote = {
      user_id: userId,
      poll_id: cookiePollId,
      side_id: selectedSide,
    };

    cookieVotes.push(newVote);
    VueCookie.set("cookieVotes", JSON.stringify(cookieVotes), {
      expires: "1d",
    });
    console.log("Vote appended:", newVote);
  }
};
</script>

<style>
.container {
  max-width: 600px;
}
</style>

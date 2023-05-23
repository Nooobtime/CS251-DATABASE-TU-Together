<template>
  <NavBar />
  <ul role="list" class="divide-y divide-gray-100 mx-4 md:mx-36">
    <li
      v-for="person in people"
      :key="person.email"
      class="flex justify-between gap-x-6 py-5"
    >
      <div class="flex gap-x-4">
        <div class="min-w-0 flex-auto">
          <p class="text-sm font-semibold leading-6 text-gray-900">
            {{ person.name }}
          </p>
          <p class="mt-1 truncate text-xs leading-5 text-gray-500">
            {{ person.email }}
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
const people = [
  {
    name: "Poll Name 1",
    email: "ลายละเอียด 1",
  },
  {
    name: "Poll Name 2",
    email: "ลายละเอียด 2",
  },
];
</script>

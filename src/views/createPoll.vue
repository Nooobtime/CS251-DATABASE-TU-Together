<template>
  <NavBar />
  <div class="min-h-screen bg-gray-100">
    <div class="container mx-auto py-8">
      <h1 class="text-3xl font-bold mb-6">Create Poll</h1>

      <div class="bg-white shadow-md rounded-md p-6 mb-6">
        <div class="mb-4">
          <label for="pollName" class="font-semibold mb-1 mr-2"
            >Poll Name:</label
          >
          <input
            type="text"
            id="pollName"
            v-model="pollName"
            placeholder="Enter poll name"
            class="border border-gray-300 rounded py-2 px-3 focus:outline-none focus:ring-blue-500"
          />
        </div>

        <div class="mb-4">
          <label for="pollInfo" class="block font-semibold mb-1"
            >Poll Info:</label
          >
          <input
            type="text"
            id="pollInfo"
            v-model="pollInfo"
            placeholder="Enter poll information"
            class="w-full border border-gray-300 rounded py-2 px-3 focus:outline-none focus:ring-blue-500"
          />
        </div>

        <!-- Start Date -->
        <div class="mb-4">
          <label for="startDate" class="font-semibold mb-1 mr-2"
            >Start Date:</label
          >
          <input
            type="date"
            id="startDate"
            v-model="startDate"
            class="border border-gray-300 rounded py-2 px-3 focus:outline-none focus:ring-blue-500"
          />
        </div>

        <!-- End Date -->
        <div class="mb-4">
          <label for="endDate" class="font-semibold mb-1 mr-2"
            >End Date:&nbsp;&nbsp;</label
          >
          <input
            type="date"
            id="endDate"
            v-model="endDate"
            class="border border-gray-300 rounded py-2 px-3 focus:outline-none focus:ring-blue-500"
          />
        </div>

        <div>
          <ul>
            <li v-for="option in options" :key="option.name" class="mb-2">
              <div class="flex items-center">
                <span class="mr-2 font-semibold">Option name:</span>
                <span>{{ option.name }}</span>
                <span class="ml-4 mr-2 font-semibold">Option description:</span>
                <span>{{ option.description }}</span>
                <button
                  @click="deleteOption(option)"
                  class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded ml-2"
                >
                  Delete Option
                </button>
              </div>
            </li>
          </ul>

          <div class="flex mb-4">
            <input
              type="text"
              v-model="newOptionName"
              placeholder="Enter option name"
              class="border border-gray-300 rounded py-2 px-3 flex-grow focus:outline-none focus:ring-blue-500"
            />
            <input
              type="text"
              v-model="newOptionDescription"
              placeholder="Enter option description"
              class="border border-gray-300 rounded py-2 px-3 flex-grow ml-2 focus:outline-none focus:ring-blue-500"
            />
            <button
              @click="addOption"
              class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded ml-2"
            >
              Add Option
            </button>
          </div>
        </div>

        <button
          @click="createPoll"
          :disabled="
            !pollName ||
            !pollInfo ||
            options.length === 0 ||
            !startDate ||
            !endDate ||
            startDate >= endDate
          "
          class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded mt-4"
        >
          Create Poll
        </button>
      </div>
    </div>

    <Footer />
  </div>
</template>

<script>
import VueCookie from "vue-cookie";

export default {
  data() {
    return {
      pollName: "",
      pollInfo: "",
      startDate: "",
      endDate: "",
      newOptionName: "",
      newOptionDescription: "",
      options: [],
    };
  },
  methods: {
    addOption() {
      if (
        this.newOptionName.trim() !== "" &&
        this.newOptionDescription.trim() !== ""
      ) {
        this.options.push({
          name: this.newOptionName,
          description: this.newOptionDescription,
        });
        this.newOptionName = "";
        this.newOptionDescription = "";
      }
    },
    deleteOption(option) {
      const index = this.options.indexOf(option);
      if (index > -1) {
        this.options.splice(index, 1);
      }
    },
    createPoll() {
      if (this.startDate >= this.endDate) {
        alert("Please select a valid start and end date.");
        return;
      }

      let cookiePollsString = VueCookie.get("cookiePolls");
      let cookieSidesString = VueCookie.get("cookieSides");
      let cookiePolls = cookiePollsString ? JSON.parse(cookiePollsString) : [];
      let cookieSides = cookieSidesString ? JSON.parse(cookieSidesString) : [];

      let poll = {
        id: (cookiePolls.length + 1).toString(),
        name: this.pollName,
        info: this.pollInfo,
        startDate: this.startDate,
        endDate: this.endDate,
      };

      let options = this.options.map((option, index) => {
        return {
          id: (index + 1).toString(), // Use index + 1 as the side ID
          poll_id: poll.id,
          name: option.name,
          info: option.description,
        };
      });
      cookiePolls.push(poll);
      options.forEach((option) => {
        cookieSides.push(option);
      });
      VueCookie.set("cookiePolls", JSON.stringify(cookiePolls), {
        expires: "1d",
      });
      VueCookie.set("cookieSides", JSON.stringify(cookieSides), {
        expires: "1d",
      });
      console.log(cookiePolls);
      console.log(cookieSides);
      this.$router.push("/polllist");
      alert("poll has been create!");
    },
  },
};
</script>

<style>
.container {
  max-width: 600px;
}
</style>

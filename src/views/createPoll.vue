<template>
  <NavBar />
  <div class="min-h-screen bg-gray-100">
    <div class="container mx-auto py-8">
      <h1 class="text-3xl font-bold mb-6">Create Poll</h1>

      <div class="bg-white shadow-md rounded-md p-6 mb-6">
        <div class="mb-4">
          <label for="pollName" class="font-semibold mb-1 mr-2">Poll Name:</label>
          <input
            type="text"
            id="pollName"
            v-model="pollName"
            placeholder="Enter poll name"
            class="border border-gray-300 rounded py-2 px-3 focus:outline-none focus:ring-blue-500"
          />
        </div>

        <div class="mb-4">
          <label for="pollInfo" class="block font-semibold mb-1">Poll Info:</label>
          <input
            type="text"
            id="pollInfo"
            v-model="pollInfo"
            placeholder="Enter poll information"
            class="w-full border border-gray-300 rounded py-2 px-3 focus:outline-none focus:ring-blue-500"
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
          :disabled="!pollName || !pollInfo || options.length === 0"
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
export default {
  data() {
    return {
      pollName: "",
      pollInfo: "",
      newOptionName: "",
      newOptionDescription: "",
      options: [],
    };
  },
  methods: {
    addOption() {
      if (this.newOptionName.trim() !== "" && this.newOptionDescription.trim() !== "") {
        this.options.push({ name: this.newOptionName, description: this.newOptionDescription });
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
      let poll = {
        id: "3",
        name: this.pollName,
        info: this.pollInfo,
      };

      let options = this.options.map((option, index) => {
        return {
          id: (index + 1).toString(),
          poll_id: poll.id,
          name: option.name,
          description: option.description,
        };
      });
      console.log(poll);
      console.log(options);
    },
  },
};
</script>

<template>
  <NavBar />

  <div class="p-4">
    <h1 class="text-2xl font-bold mb-4">Create Poll</h1>
    <div class="mb-4">
      <label for="pollName" class="block font-semibold mb-1">Poll Name:</label>
      <input
        type="text"
        id="pollName"
        v-model="pollName"
        placeholder="Enter poll name"
        class="w-full border border-gray-300 rounded py-2 px-3"
      />
      <label for="pollInfo" class="block font-semibold mt-2 mb-1"
        >Poll Info:</label
      >
      <input
        type="text"
        id="pollInfo"
        v-model="pollInfo"
        placeholder="Enter poll information"
        class="w-full border border-gray-300 rounded py-2 px-3"
      />
    </div>

    <ul>
      <li v-for="item in items" :key="item.a" class="mb-2">
        <div>
          Side name: {{ item.a }} Side description:{{ item.b }}
          <button
            @click="deleteItem(item)"
            class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded ml-2"
          >
            Delete Option
          </button>
        </div>
        <span class="font-semibold"> </span>
      </li>
    </ul>
    <div class="mb-4">
      <input
        type="text"
        v-model="inputA"
        placeholder="Enter option name"
        class="border border-gray-300 rounded py-2 px-3 mb-2"
      />
      <input
        type="text"
        v-model="inputB"
        placeholder="Enter option description"
        class="border border-gray-300 rounded py-2 px-3"
      />
      <button
        @click="addItem"
        class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded mt-2"
      >
        Add Option
      </button>
    </div>
    <button
      @click="createPoll"
      :disabled="!pollName || !pollInfo || items.length === 0"
      class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded mt-4"
    >
      Create Poll
    </button>
  </div>
  <Footer />
</template>

<script>
export default {
  data() {
    return {
      pollName: "",
      pollInfo: "",
      inputA: "",
      inputB: "",
      items: [],
    };
  },
  methods: {
    addItem() {
      if (this.inputA.trim() !== "" && this.inputB.trim() !== "") {
        this.items.push({ a: this.inputA, b: this.inputB });
        this.inputA = "";
        this.inputB = "";
      }
    },
    deleteItem(item) {
      const index = this.items.indexOf(item);
      if (index > -1) {
        this.items.splice(index, 1);
      }
    },
    createPoll() {
      let poll = {
        id: "3",
        name: this.pollName,
        info: this.pollInfo,
      };

      let sides = this.items.map((item, index) => {
        return {
          id: (index + 1).toString(),
          poll_id: poll.id,
          name: item.a,
          info: item.b,
        };
      });
      //this.$router.push("/polllist");
      console.log(poll);
      console.log(sides);
    },
  },
};
</script>

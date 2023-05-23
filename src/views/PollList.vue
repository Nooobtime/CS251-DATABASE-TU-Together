<template>
  <NavBar />
  <h1>รายการ Poll</h1>
  <div class="mx-10 flex justify-end">
    <button
      type="button"
      class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2"
    >
      <router-link to="/">All Poll</router-link>
    </button>
    <button
      type="button"
      class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2"
    >
      <router-link to="/">My Poll</router-link>
    </button>
  </div>
  <div class="mx-10 my-4 relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left text-gray-500">
      <thead class="text-xs text-gray-700 uppercase bg-gray-50">
        <tr>
          <th scope="col" class="px-5 py-3">Product name</th>
          <th scope="col" class="px-5 py-3">Category</th>
          <th scope="col" class="px-5 py-3">Price</th>
          <th scope="col" class="px-5 py-3">Action</th>
        </tr>
      </thead>
      <tbody>
        <tr class="bg-white border-b">
          <th
            scope="row"
            class="px-5 py-4 font-medium text-gray-900 whitespace-nowrap"
          >
            Apple MacBook Pro 17"
          </th>
          <td class="px-5 py-4">Laptop</td>
          <td class="px-5 py-4">$2999</td>
          <td class="px-5 py-4">
            <a href="#" class="font-medium text-blue-600">Edit </a>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  <button
    type="button"
    class="mx-10 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 focus:outline-none"
  >
    Create Poll
  </button>
  <Footer />
</template>

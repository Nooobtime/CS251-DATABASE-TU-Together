<template>
  <nav class="fixed top-0 left-0 w-full z-50">
    <Disclosure as="nav" class="bg-gray-800" v-slot="{ open }">
      <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
          <div class="flex items-center">
            <div class="flex-shrink-0">
              <img
                class="h-8 w-8 mb-2"
                src="../assets/logo/TU_logo.png"
                alt="Your Company"
              />
            </div>
            <div class="hidden md:block"></div>
          </div>
          <div class="hidden md:block">
            <div class="ml-4 flex items-center md:ml-6">
              <div class="ml-10 flex items-baseline space-x-4">
                <router-link
                  to="/"
                  class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium"
                >
                  home
                </router-link>
                <router-link
                  to="/polllist"
                  class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium"
                >
                  Poll
                </router-link>
                <button
                  class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium"
                  @click="logout"
                >
                  Logout
                </button>
              </div>
              <!-- Profile dropdown -->
              <Menu as="div" class="relative ml-3">
                <div>
                  <MenuButton
                    class="flex max-w-xs items-center rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
                  >
                    <span class="sr-only">Open user menu</span>
                  </MenuButton>
                </div>
              </Menu>
            </div>
          </div>
          <div class="-mr-2 flex md:hidden">
            <!-- Mobile menu button -->
            <DisclosureButton
              class="inline-flex items-center justify-center rounded-md bg-gray-800 p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
            >
              <span class="sr-only">Open main menu</span>
              <Bars3Icon
                v-if="!open"
                class="block h-6 w-6"
                aria-hidden="true"
              />
              <XMarkIcon v-else class="block h-6 w-6" aria-hidden="true" />
            </DisclosureButton>
          </div>
        </div>
      </div>

      <DisclosurePanel class="md:hidden">
        <div class="space-y-1 px-2 pb-3 pt-2 sm:px-3">
          <div>
            <router-link
              to="/"
              class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium"
            >
              Home
            </router-link>
          </div>
          <div>
            <router-link
              to="/polllist"
              class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium"
            >
              Poll
            </router-link>
          </div>
            <div v-if="isAdmin">
              <router-link
                to="/createPoll"
                class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium"
              >
                Create
              </router-link>
            </div>
          <div>
            <span
              class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium"
              @click="logout"
            >
              Logout
            </span>
          </div>
        </div>
      </DisclosurePanel>
    </Disclosure>
  </nav>
  <div class="pt-20"></div>
</template>

<script setup>
import {
  Disclosure,
  DisclosureButton,
  DisclosurePanel,
  Menu,
  MenuButton,
} from "@headlessui/vue";
import { Bars3Icon, XMarkIcon } from "@heroicons/vue/24/outline";
</script>

<script>
import VueCookie from "vue-cookie";
export default {
  data() {
    return {
      isAdmin: true,
    };
  },
  methods: {
    logout() {
      VueCookie.delete("TUTogetherUserData");
      this.$router.push("/login");
    },
    navigate(href) {
      this.$router.push(href);
    },
    isAdmin() {
      //get userid from cookie
      //https://restapi.tu.ac.th/tuapi/docs/GettingAuth
      //check userid from database admin?
      /*if(){
        is admin
      }
      else if{
        not admin
      }
      else{
        no user in database
        add user
      }*/
    },
  },
};
</script>

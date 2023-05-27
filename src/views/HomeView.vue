<template>
  <NavBar />
  <div class="bg-white pb-10">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div
        class="relative isolate overflow-hidden bg-gray-900 px-6 pt-16 shadow-2xl sm:rounded-3xl sm:px-16 md:pt-24 lg:flex lg:gap-x-20 lg:px-24 lg:pt-0"
      >
        <svg
          viewBox="0 0 1024 1024"
          class="absolute left-1/2 top-1/2 -z-10 h-[64rem] w-[64rem] -translate-y-1/2 [mask-image:radial-gradient(closest-side,white,transparent)] sm:left-full sm:-ml-80 lg:left-1/2 lg:ml-0 lg:-translate-x-1/2 lg:translate-y-0"
          aria-hidden="true"
        >
          <circle
            cx="512"
            cy="512"
            r="512"
            fill="url(#759c1415-0410-454c-8f7c-9a820de03641)"
            fill-opacity="0.7"
          />
          <defs>
            <radialGradient id="759c1415-0410-454c-8f7c-9a820de03641">
              <stop stop-color="#7775D6" />
              <stop offset="1" stop-color="#E935C1" />
            </radialGradient>
          </defs>
        </svg>
        <div
          class="mx-auto max-w-md text-center lg:mx-0 lg:flex-auto lg:py-32 lg:text-left"
        >
          <h2 class="text-3xl font-bold tracking-tight text-white sm:text-4xl">
            TU Together
          </h2>
          <p class="mt-6 text-lg leading-8 text-gray-300">
            แพลตฟอร์มการแสดงความเห็น
          </p>
          <div
            class="mt-10 flex items-center justify-center gap-x-6 lg:justify-start"
          >
            <router-link to="/polllist">
              <a
                class="rounded-md bg-white px-3.5 py-2.5 text-sm font-semibold text-gray-900 shadow-sm hover:bg-gray-100 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white"
              >
                ค้าหา poll
              </a>
            </router-link>
            <router-link to="/">
              <a class="text-sm font-semibold leading-6 text-white"
                ><span aria-hidden="true"></span></a
            ></router-link>
          </div>
        </div>
        <div class="relative mt-16 h-80 lg:mt-8">
          <img
            class="absolute left-0 top-0 w-[57rem] max-w-none rounded-md bg-white/5 ring-1 ring-white/10"
            src="https://tailwindui.com/img/component-images/dark-project-app-screenshot.png"
            alt="App screenshot"
            width="1824"
            height="1080"
          />
        </div>
      </div>
    </div>
  </div>
  <div class="bg-white py-10">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
      <dl class="grid grid-cols-1 gap-x-8 gap-y-16 text-center lg:grid-cols-3">
        <div
          v-for="quote in commentQuotes"
          :key="quote.id"
          class="mx-auto flex max-w-xs flex-col gap-y-4"
        >
          <dt class="text-base leading-7 text-gray-600">
            {{ quote.description }}
          </dt>
          <dd
            class="order-first text-3xl font-semibold tracking-tight text-gray-900 sm:text-5xl"
          >
            {{ quote.title }}
          </dd>
        </div>
      </dl>
    </div>
  </div>
  <Footer />
</template>

<script setup>
const commentQuotes = [
  { id: 1, description: "เลือกสิ่งที่ถูกใจ ใช่กับตัวเรา", title: "เลือก" },
  { id: 2, description: "ไม่นอนหลับทับสิทธิ์", title: "ใช้สิทธิ์" },
  { id: 3, description: "เกรด D ก็ได้", title: "ลงความเห็น" },
];
</script>

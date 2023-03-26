<template>
  <div>
    <div
      class="bg-slate-100 p-5 flex justify-between items-center border-bottom"
    >
      <h1 class="text-2xl">Product List</h1>

      <div class="flex gap-3 content-center">
        <router-link
          :to="{ name: 'AddProduct' }"
          class="bg-green-600 border-green-800 px-5 py-3 text-white"
        >
          ADD
        </router-link>

        <button
          type="button"
          id="delete-product-btn"
          class="bg-red-600 border-red-900 px-5 py-3 text-white"
        >
          MASS DELETE
        </button>
      </div>
    </div>

      <div
        class="flex flex-wrap items-center lg:justify-between justify-center mt-5"
      >
        <div
          tabindex="0"
          class="focus:outline-none w-72 xl:mb-0 mb-8"
          v-for="i in [0, 1, 3, 4, 5]"
        >
          <div>
            <img
              alt="person capturing an image"
              src="https://cdn.tuk.dev/assets/templates/classified/Bitmap (1).png"
              tabindex="0"
              class="focus:outline-none w-full h-44"
            />
          </div>
          <div class="bg-white">
            <div class="flex items-center justify-between px-4 pt-4">
              <div>
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  tabindex="0"
                  class="focus:outline-none"
                  width="20"
                  height="20"
                  viewBox="0 0 24 24"
                  stroke-width="1.5"
                  stroke="#2c3e50"
                  fill="none"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                >
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                  <path
                    d="M9 4h6a2 2 0 0 1 2 2v14l-5-3l-5 3v-14a2 2 0 0 1 2 -2"
                  ></path>
                </svg>
              </div>
              <div class="bg-yellow-200 py-1.5 px-6 rounded-full">
                <p
                  tabindex="0"
                  class="focus:outline-none text-xs text-yellow-700"
                >
                  Featured
                </p>
              </div>
            </div>
            <div class="p-4">
              <div class="flex items-center">
                <h2
                  tabindex="0"
                  class="focus:outline-none text-lg font-semibold"
                >
                  iphone XS
                </h2>
                <p
                  tabindex="0"
                  class="focus:outline-none text-xs text-gray-600 pl-5"
                >
                  4 days ago
                </p>
              </div>
              <p
                tabindex="0"
                class="focus:outline-none text-xs text-gray-600 mt-2"
              >
                The Apple iPhone XS is available in 3 colors with 64GB memory.
                Shoot amazing videos
              </p>
              <div class="flex mt-4">
                <div>
                  <p
                    tabindex="0"
                    class="focus:outline-none text-xs text-gray-600 px-2 bg-gray-200 py-1"
                  >
                    12 months warranty
                  </p>
                </div>
                <div class="pl-2">
                  <p
                    tabindex="0"
                    class="focus:outline-none text-xs text-gray-600 px-2 bg-gray-200 py-1"
                  >
                    Complete box
                  </p>
                </div>
              </div>
              <div class="flex items-center justify-between py-4">
                <h2
                  tabindex="0"
                  class="focus:outline-none text-indigo-700 text-xs font-semibold"
                >
                  Bay Area, San Francisco
                </h2>
                <h3
                  tabindex="0"
                  class="focus:outline-none text-indigo-700 text-xl font-semibold"
                ></h3>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
</template>

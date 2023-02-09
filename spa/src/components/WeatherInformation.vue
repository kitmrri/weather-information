<template>
  <div class="flex" @click="toggleDrawer">
    <button data-drawer-target="cities-sidebar" data-drawer-toggle="cities-sidebar" aria-controls="cities-sidebar" type="button" class="inline-flex items-center p-2 mt-2 ml-3 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
      <span class="sr-only">Open sidebar</span>
      <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
          <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
      </svg>
    </button>
    <aside id="cities-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
      <div class="h-full px-3 py-4 overflow-y-auto bg-transparent">
          <ul class="space-y-2">
            <li class="p-4 text-black transition-all duration-200 ease-in-out rounded-lg shadow-md cursor-pointer hover:bg-gray-700" v-for="(city, key) in cities" @click="selectCity(city)" :key="key">
              {{ city }}
            </li>
          </ul>
      </div>
    </aside>
    <div class="w-full p-4 sm:ml-64">
      <div class="p-4 overflow-y-scroll border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
        <SelectedCity :selectedCity="selectedCity"/>
      </div>
    </div>
  </div>
</template>

<script>
import { inject } from "vue";
import SelectedCity from "./SelectedCity.vue";

export default {
  components: {
    SelectedCity
  },
  data() {
    return {
      axios: inject("axios"),
      cities: [],
      selectedCity: 'Tokyo'
    };
  },
  mounted() {
    this.fetchCities();
  },
  methods: {
    async fetchCities() {
      try {
        const response = await this.axios.get("/api/cities");
        this.cities = response.data;
      } catch (error) {
        console.error(error);
      }
    },
    selectCity(city) {
      this.selectedCity = city;
    },
    toggleDrawer() {
      const sidebar = document.getElementById("cities-sidebar");
      sidebar.classList.toggle("sm:translate-x-0");
      sidebar.classList.toggle("-translate-x-full");
    }
  }
};
</script>
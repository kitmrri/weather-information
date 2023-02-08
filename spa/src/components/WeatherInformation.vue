<template>
  <div class="flex bg-cover bg-center" style="background-image: url('./src/assets/background.jpg');">
    <div class="w-1/4 p-4 bg-transparent text-white">
      <h3 class="text-xl font-bold mb-4 ">Cities</h3>
      <ul class="list-group overflow-y-scroll max-h-screen min-h-screen">
        <li class="list-group-item cursor-pointer hover:bg-gray-400 transition-all duration-200 ease-in-out p-4" v-for="(city, key) in cities" @click="selectCity(city)" :key="key">
          {{ city }}
        </li>
      </ul>
    </div>
    <div class="w-3/4 p-4 bg-transparent">
      <SelectedCity :selectedCity="selectedCity"/>
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
      selectedCity: ''
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
    }
  }
};
</script>

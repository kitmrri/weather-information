<template>
  <div class="container">
    <div class="w-1/4 p-4">
      <h3>Cities</h3>
      <ul>
        <li v-for="city in cities" @click="selectCity(city)">{{ city }}</li>
      </ul>
    </div>
    <div class="w-3/4 p-4">
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
  created() {
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

<style scoped>
.container {
  display: flex;
}

.left-column {
  width: 25%;
  padding: 20px;
}

.right-column {
  width: 75%;
  padding: 20px;
}
</style>
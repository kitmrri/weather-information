<template>
  <div class="h-screen flex flex-col widget">
    <div class="text-lg text-center font-medium bg-sky-300">
      <h2>City: {{ selectedCity }}</h2>
      <h3>Current Weather:</h3>
      <div v-if="currentWeather.main">
        <p>{{ currentWeather.main.temp }} &#8451;</p>
        <p class="text-transform: capitalize">
          <img :src="'http://openweathermap.org/img/wn/' + currentWeather.weather[0].icon + '@2x.png'"
              style="display: inline-block; vertical-align: middle;">
          {{ currentWeather.weather[0].description }}
        </p>
      </div>
    </div>
    <div class="flex h-full">
      <div class="flex-1 flex flex-col">
        <div class="bg-sky-200 h-full flex-grow-0 overflow-y-auto overscroll-contain">
          <div class="bg-gray-300 text-center py-4">
            <h2 class="text-lg font-medium">5 Day Forecast:</h2>
          </div>   
          <div class="border rounded p-4 mb-4" v-for="(forecasts, date) in groupedForecasts" :key="date">
            <ul>
              <li v-for="(forecast, index) in forecasts" :key="index">
                <p>{{ formatDate(forecast.dt) }} - {{ forecast.main.temp }} &#8451;</p>
                <p class="text-transform: capitalize">
                  <img :src="'http://openweathermap.org/img/wn/' + forecast.weather[0].icon + '@2x.png'" style="display: inline-block; vertical-align: middle;">
                  {{ forecast.weather[0].description }}
                </p>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="flex-1 bg-sky-200">
        <div class="bg-gray-300 text-center py-4">
          <h2 class="text-lg font-medium">Tourist Attractions</h2>
        </div>    
        <ul>
          <li class="border rounded p-4 mb-4" v-for="(information, key) in placeInformation" :key="key">
            <p>Name: {{ information.name }}</p>
            <p>Address: {{ information.address_line }}</p>
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
import { inject } from "vue";

export default {
  props: ["selectedCity"],
  data() {
    return {
      axios: inject("axios"),
      fiveDayForecast: [],
      currentWeather: [],
      placeInformation: []
    };
  },
  watch: {
    selectedCity() {
      this.fetchWeatherData(this.selectedCity);
    }
  },
  created() {
    this.fetchWeatherData(this.selectedCity);
  },
  computed: {
    groupedForecasts() {
      const grouped = {};
      this.fiveDayForecast.forEach(forecast => {
        const date = this.formatDate(forecast.dt).split(',')[0];
        if (!grouped[date]) {
          grouped[date] = [];
        }
        grouped[date].push(forecast);
      });
      return grouped;
    },
    iconUrl() {
      return `http://openweathermap.org/img/wn/${this.currentWeather.weather[0].icon}@2x.png`;
    }
  },
  methods: {
    async fetchWeatherData(selectedCity) {
      if (selectedCity) {
        try {
          const [currentWeatherResponse, fiveDayForecastResponse, placeInformation] = await Promise.all([
            this.axios.get("/api/weather", {params: {city: selectedCity}}),
            this.axios.get("/api/forecast", {params: {city: selectedCity}}),
            this.axios.get("/api/geoapify", {params: {city: selectedCity}})
          ]);
          this.currentWeather = currentWeatherResponse.data;
          this.fiveDayForecast = fiveDayForecastResponse.data;
          this.placeInformation = placeInformation.data
          console.log(this.fiveDayForecast)
        } catch (error) {
          console.error(error);
        }
      }
    },
    formatDate(dateString) {
      const date = new Date(dateString * 1000);
      return date.toLocaleString();
    }
  }
};
</script>

<style scoped>
.img{
  display: inline-block;
  vertical-align: middle;
}
</style>
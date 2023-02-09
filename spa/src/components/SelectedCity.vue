<template>
  <div class="flex flex-col h-screen widget">
    <div class="text-lg font-bold tracking-wide text-center text-black bg-center bg-cover" :style="backgroundImage" v-if="currentWeather.main">
      <h2 class="capitalize text-transform:">
        Current Weather in {{selectedCity}}: {{ currentWeather.main.temp }} &#8451; - {{ currentWeather.weather[0].description }}
          <img :src="'http://openweathermap.org/img/wn/' + currentWeather.weather[0].icon + '.png'"
            style="display: inline-block; vertical-align: middle;">
      </h2>
    </div>
    <div class="flex h-full text-black">
      <div class="flex-1 flex-grow">
        <div class="h-full overflow-y-auto overscroll-contain">
          <div class="py-2 text-center">
            <h2 class="text-lg font-medium">5 Day Forecast:</h2>
          </div>   
          <div class="p-4 mb-4" v-for="(forecasts, date) in groupedForecasts" :key="date">
            <ul>
              <li v-for="(forecast, index) in forecasts" :key="index">
                {{ formatDate(forecast.dt) }} - {{ forecast.main.temp }} &#8451; - {{ forecast.weather[0].description }}
                <img :src="'http://openweathermap.org/img/wn/' + forecast.weather[0].icon + '.png'" style="display: inline-block; vertical-align: middle;">
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="flex-1 flex-grow">
        <TabContainer :placeInformation="placeInformation"/>
      </div>
    </div>
  </div>
</template>


<script>
import { inject } from "vue";
import TabContainer from "./TabContainer.vue";

export default {
  props: ["selectedCity"],
  components: {
    TabContainer
  },
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
    backgroundImage() {
      let imageUrl = "./src/assets/" + this.selectedCity + ".png";
      return {
        "background-image": `url(${imageUrl})`
      };
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
.list-group {
  max-height: 80vh;
  overflow-y: scroll;
}
</style>
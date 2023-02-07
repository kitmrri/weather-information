<template>
  <div class="widget">
    <div class="widget-header">
      <h2>{{ selectedCity }}</h2>
    </div>
    <div class="widget-body">
      <div v-if="currentWeather.main">
        <h3>Current Weather:</h3>
        <p>{{ currentWeather.main.temp }} &#8451;</p>
        <p>{{ currentWeather.weather[0].description }}</p>
      </div>
      <div>
        <h3>5-Day Forecast:</h3>
        <ul>
          <li v-for="forecast in fiveDayForecast">
            {{ formatDate(forecast.dt_txt) }} - {{ forecast.main.temp }} &#8451; - {{ forecast.weather[0].description }}
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
      currentWeather: []
    };
  },
  watch: {
    selectedCity() {
      this.fetchWeatherData(this.selectedCity);
    }
  },
  created() {
    this.fetchWeatherData(this.selectedCity);
    setInterval(() => {
      console.log('refresh')
      this.fetchWeatherData();
    }, 4000);
  },
  methods: {
    async fetchWeatherData(selectedCity) {
      if (selectedCity) {
        try {
          const currentWeatherResponse = await this.axios.post("/api/fetchCurrentWeatherData", { selectedCity });
          this.currentWeather = currentWeatherResponse.data;

          const fiveDayForecastResponse = await this.axios.post("/api/fetchForecastData", { selectedCity });
          this.fiveDayForecast = fiveDayForecastResponse.data.list;
        } catch (error) {
          console.error(error);
        }
      }
    },
    formatDate(dateString) {
      const date = new Date(dateString);
      return date.toLocaleDateString();
    }
  }
};
</script>

<style scoped>
.widget {
  width: 300px;
  border: 1px solid lightgray;
  border-radius: 5px;
  overflow: hidden;
}
.widget-header {
  background-color: lightgray;
  padding: 10px;
  text-align: center;
}
.widget-body {
  padding: 10px;
}
</style>
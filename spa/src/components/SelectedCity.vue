<template>
  
  <div>
    <h2>Selected City: {{ selectedCity }}</h2>
    <h3>5-Day Forecast:</h3>
    <ul>
      <li v-for="forecast in fiveDayForecast">
        {{ forecast.dt_txt }} - {{ forecast.main.temp }} - {{ forecast.weather[0].description }}
      </li>
    </ul>
  </div>
</template>

<script>
import { inject } from "vue";
export default {
  props: ["selectedCity"],
  data() {
    return {
      axios: inject("axios"),
      fiveDayForecast: []
    };
  },
  watch: {
    selectedCity() {
      this.fetchWeatherData();
    }
  },
  mounted() {
    this.fetchWeatherData();
  },
  methods: {
    fetchWeatherData() {
      if (this.selectedCity) {  
        this.axios.get(`https://api.openweathermap.org/data/2.5/forecast?q=${this.selectedCity}&appid=${import.meta.env.VITE_WEATHER_API_KEY}`)
          .then(response => {
            this.fiveDayForecast = response.data.list;
          })
          .catch(error => {
            console.error(error);
          });
      }
    }
  }
};
</script>
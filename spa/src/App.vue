<script setup>
import { RouterLink, RouterView } from "vue-router";
import WeatherInformation from "./components/WeatherInformation.vue";
import { inject, onMounted, ref } from "vue";

const axios = inject("axios");
const message = ref("");

const fetchData = async () => {
  const response = await axios.get("/api/cities");
  message.value = response.data;
};

onMounted(fetchData);
</script>

<template>
  <RouterView />
</template>


<style>
body
{
  background-image:url('./src/assets/background.png');
  background-size: cover;
} 
</style>
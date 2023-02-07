<script setup>
import { RouterLink, RouterView } from "vue-router";
import HelloWorld from "./components/HelloWorld.vue";
import { inject, onMounted, ref } from "vue";

const axios = inject("axios");

const publicEnvVar = import.meta.env;
console.log("publicEnvVar: ", publicEnvVar);
console.log("axios: ", axios);

const message = ref("");

const fetchData = async () => {
  const response = await axios.get("/api/cities");
  message.value = response.data;
};

onMounted(fetchData);
</script>

<template>
  <div>
    <header>
      <img
        alt="Vue logo"
        class="logo"
        src="@/assets/logo.png"
        width="125"
        height="125"
      />

      <div class="flex flex-row">
        <HelloWorld msg="You did it!" />

        <nav>
          <RouterLink to="/">Home</RouterLink>
          <RouterLink to="/about">About</RouterLink>
        </nav>
      </div>
    </header>

    <RouterView />
  </div>
</template>

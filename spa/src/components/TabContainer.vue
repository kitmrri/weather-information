<template>
  <div class="h-full">
    <div class="text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:text-gray-400 dark:border-gray-700">
      <ul class="flex flex-wrap -mb-px">
        <li class="mr-2">
          <a href="#" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
            @click="activeTab = 'touristAttractions'"
            :class="['inline-block p-4 border-b-2 border-transparent rounded-t-lg', {'text-zinc-50 active': activeTab === 'touristAttractions'}]"
            aria-current="page"
            >Tourist Attractions</a>
        </li>
        <li class="mr-2">
          <a href="#" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
            @click="activeTab = 'restaurants'"
            :class="['inline-block p-4 border-b-2 border-transparent rounded-t-lg', {'text-zinc-50 active': activeTab === 'restaurants'}]"
            aria-current="page">Restaurants</a>
        </li>
      </ul>
    </div>
    <div class="h-full flex-grow-0 overflow-y-auto overscroll-contain" v-if="activeTab === 'touristAttractions'">
      <div class="text-center py-2">
      </div>    
      <ul>
        <li class="border border-slate-600 rounded p-4 mb-4" v-for="(touristSpot, key) in touristSpots" :key="key">
          <p>Name: {{ touristSpot.name }}</p>
          <p>Address: {{ touristSpot.address_line }}</p>
          <a :href="`https://www.google.com/maps/search/?api=1&query=${encodeURI(touristSpot.name)}`" target="_blank" class="text-blue-300">Open Map</a>
        </li>
      </ul>
    </div>
    <div v-else>
      <div class="text-center py-4">
      </div>    
      <ul>
        <li class="border border-slate-600 rounded p-4 mb-4" v-for="(restaurant, key) in restaurants" :key="key">
          <p>Name: {{ restaurant.name }}</p>
          <p>Address: {{ restaurant.address_line }}</p>
          <a :href="`https://www.google.com/maps/search/?api=1&query=${encodeURI(restaurant.name)}`" target="_blank" class="text-blue-300">Open Map</a>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
export default {
  props: ["placeInformation"],
  data() {
    return {
      activeTab: 'touristAttractions'
    };
  },
  computed: {
    restaurants() {
      return this.placeInformation.filter(item => item.category === 'catering.restaurant');
    },
    touristSpots() {
      return this.placeInformation.filter(item => item.category === 'tourism.sights');
    }
  }
};
</script>

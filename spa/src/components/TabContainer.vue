<template>
  <div class="h-full overflow-y-auto overscroll-contain">
    <div class="text-sm font-medium text-center border-b border-gray-200 dark:text-black dark:border-gray-700">
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
    <div v-if="activeTab === 'touristAttractions'">
      <div class="py-2 text-center">
      </div>    
      <ul>
        <li class="p-4 mb-4 border rounded border-slate-600" v-for="(touristSpot, key) in touristSpots" :key="key">
          <p>Name: {{ touristSpot.name }}</p>
          <p>Address: {{ touristSpot.address_line }}</p>
          <a :href="`https://www.google.com/maps/search/?api=1&query=${encodeURI(touristSpot.name)}`" target="_blank" class="text-blue-700">Open Map</a>
        </li>
      </ul>
    </div>
    <div v-else>
      <div class="py-4 text-center">
      </div>    
      <ul>
        <li class="p-4 mb-4 border rounded border-slate-600" v-for="(restaurant, key) in restaurants" :key="key">
          <p>Name: {{ restaurant.name }}</p>
          <p>Address: {{ restaurant.address_line }}</p>
          <a :href="`https://www.google.com/maps/search/?api=1&query=${encodeURI(restaurant.name)}`" target="_blank" class="text-blue-600">Open Map</a>
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

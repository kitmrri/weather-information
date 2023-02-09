import { createRouter, createWebHistory } from 'vue-router'
import InformationView from '../views/InformationView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'information',
      component: InformationView
    },

  ]
})

export default router

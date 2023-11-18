import { createRouter, createWebHistory } from 'vue-router'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/login',
      name: 'login',
      meta: {
        requiresAuth: false
      },
      component: () => import('../views/Login.vue')
    },
    {
      path: '/',
      name: 'index',
      component: () => import('../layouts/Main.vue'),
      children: [
        {
          path: 'dashboard',
          name: 'dashboard',
          meta: {
            requiresAuth: true
          },
          component: () => import('../views/Dashboard.vue')
        }
      ]
    }
  ]
})

export default router

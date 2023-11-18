import { createRouter, createWebHistory } from 'vue-router'
import { useAuthStore } from '@/stores/authStore'

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
        },
        {
          path: 'buy',
          name: 'buy',
          meta: {
            requiresAuth: true
          },
          component: () => import('../views/TransactionBuy.vue')
        },
        {
          path: 'sell',
          name: 'sell',
          meta: {
            requiresAuth: true
          },
          component: () => import('../views/TransactionSell.vue')
        },
        {
          path: 'summary',
          name: 'summary',
          meta: {
            requiresAuth: true
          },
          component: () => import('../views/Summary.vue')
        }
      ]
    }
  ]
})

router.beforeEach(async (to, from, next) => {
  const authStore = useAuthStore()
  if (to.matched.some((record) => record.meta.requiresAuth)) {
    if (!authStore.isLoggedIn) {
      next({ name: 'login' })
    } else {
      next()
    }
  } else {
    if (authStore.isLoggedIn) {
      next({ name: 'dashboard' })
    } else {
      next()
    }
  }
})

export default router

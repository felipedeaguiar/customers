import { createRouter, createWebHistory } from 'vue-router'
import CustomerView from '../views/CustomerView.vue'
import AddCustomerView from '../views/AddCustomerView.vue'
import EditCustomerView from '../views/EditCustomerView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'customer',
      component: CustomerView
    },
    {
      path: '/customer/add',
      name: 'add-customer',
      component: AddCustomerView
    },
    {
      path: '/customer/:id/edit',
      name: 'edit-customer',
      component: EditCustomerView
    },
    {
      path: '/about',
      name: 'about',
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import('../views/AboutView.vue')
    }
  ]
})

export default router

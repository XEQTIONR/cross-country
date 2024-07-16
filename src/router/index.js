import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import LoginView from '../views/LoginView.vue'
import { useData } from '../composables/useData.js'
import RegisterView from '@/views/RegisterView.vue'
import LcsView from '@/views/LcsView.vue'
import ConsignmentsView from '@/views/ConsignmentsView.vue'
import ContainersView from '@/views/ContainersView.vue'
import CustomersView from '@/views/CustomersView.vue'
import TyresView from '@/views/TyresView.vue'
import OrdersView from '@/views/OrdersView.vue'
import PaymentsView from '@/views/PaymentsView.vue'
import StockView from '@/views/StockView.vue'
import BankAccountsView from '@/views/BankAccountsView.vue'
import UsersView from '@/views/UsersView.vue'
import UnauthorizedView from '@/views/UnauthorizedView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView
    },
    {
      path: '/about',
      name: 'about',
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import('../views/AboutView.vue')
    },
    {
      path: '/register',
      name: 'register',
      component: RegisterView
    },
    {
      path: '/login',
      name: 'login',
      component: LoginView
    },
    {
      path: '/private/another',
      name: 'another',
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import('../views/AnotherView.vue')
    },
    {
      path: '/private/me',
      name: 'me',
      component: () => import ('../views/CurrentUserView.vue')
    },
    {
      path: '/private/new',
      name: 'new',
      component: () => import('../views/NewView.vue')
    },
    {
      path: '/bank_accounts',
      name: 'bank_accounts.index',
      component: BankAccountsView
    },
    {
      path: '/lcs',
      name: 'lcs.index',
      component: LcsView
    },
    {
      path: '/consignments',
      name: 'consignments.index',
      component: ConsignmentsView
    },
    {
      path: '/containers',
      name: 'containers.index',
      component: ContainersView
    },
    {
      path: '/customers',
      name: 'customers.index',
      component: CustomersView
    },
    {
      path: '/stock',
      name: 'stock.index',
      component: StockView
    },
    {
      path: '/tyres',
      name: 'tyres.index',
      component: TyresView
    },
    {
      path: '/users',
      name: 'users.index',
      component: UsersView
    },
    {
      path: '/orders',
      name: 'orders.index',
      component: OrdersView
    },
    {
      path: '/payments',
      name: 'payments.index',
      component: PaymentsView
    },
    {
      path: '/unauthorized',
      name: 'unauthorized',
      component: UnauthorizedView
    },
  ]
})

router.beforeEach(async (to) => {
  const data  = await useData(to.fullPath, router,)
  window.data = data
})



export default router

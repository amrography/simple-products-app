import { createRouter, createWebHistory } from 'vue-router'
import Products from './pages/Products.vue'
import AddProduct from './pages/AddProduct.vue';
import NotFound from './pages/NotFound.vue';

const routes = [
  {
    path: '/',
    name: 'Products',
    component: Products
  },
  {
    path: '/add-product',
    name: 'AddProduct',
    component: AddProduct
  },
  {
    path: "/:catchAll(.*)",
    component: NotFound,
  }
]
const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router;

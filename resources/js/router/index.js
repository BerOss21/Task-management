import { createWebHistory, createRouter } from 'vue-router'

import Home from '../views/Home.vue';
import Show from '../views/Show.vue';

const routes = [
  { path: '/',name:'home', component: Home },
  { path: '/tasks/:id',name:'detail', component: Show },
]

const router=createRouter({
  history:createWebHistory(),
  routes
});

export default router;
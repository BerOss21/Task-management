import { createWebHistory, createRouter } from 'vue-router'

import Home from '../views/Home.vue';
import Show from '../views/Show.vue';
import Login from '../views/Login.vue';

const routes = [
  { path: '/',name:'home', component: Home, 'meta':{requiredAuth:true} },
  { path: '/tasks/:id',name:'detail', component: Show, 'meta':{requiredAuth:true} },
  { path: '/signin',name:'login', component: Login, 'meta':{requiredAuth:false}},
]

const router=createRouter({
  history:createWebHistory(),
  routes
});

router.beforeEach((to, from, next) => {
console.log(localStorage.getItem('user'))

  if (to.meta.requiredAuth && !localStorage.getItem('user')) {
      next({name: 'login'});
  } 

  else if (!to.meta.requiredAuth && localStorage.getItem('user')) {
      next({name:'home'});
  }
});

export default router;
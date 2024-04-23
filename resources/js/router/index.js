import { createMemoryHistory, createRouter } from 'vue-router'

import Home from '../components/Home.vue';
import Contact from '../components/Contact.vue';

const routes = [
  { path: '/',name:'home', component: Home },
  { path: '/contact',name:'contact', component: Contact },
]

const router = createRouter({
  history: createMemoryHistory(),
  routes,
})

export default router;
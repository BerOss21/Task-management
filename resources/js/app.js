import './bootstrap';
import {createApp} from 'vue'

import App from './App.vue';
import router from './router';
import { createPinia } from 'pinia';
const pinia = createPinia();


window.axios.interceptors.response.use(
response => {
    return response;
},
error => {
    if (error.response && error.response.status === 401) {
        localStorage.removeItem('user')
        router.push({name:'login'})
    }
    return Promise.reject(error);
}
);


createApp(App)
.use(router)
.use(pinia)
.mount("#app")
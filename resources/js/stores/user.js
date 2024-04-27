import { defineStore } from 'pinia';
import { ref } from 'vue';

export const useUserStore = defineStore('user', () => {
    const user = ref(JSON.parse(localStorage.getItem('user'))??null);
    const updateUser=()=>{
        user.value=JSON.parse(localStorage.getItem('user'))
    }

    return {
        user,
        updateUser
    }
})
import { defineStore } from 'pinia';
import { ref } from 'vue';

export const useUserStore = defineStore('user', () => {
    const user = ref(localStorage.getItem('user')??null);
    const updateUser=()=>{
        user.value=localStorage.getItem('user')
    }

    return {
        user,
        updateUser
    }
})
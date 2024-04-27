<template>
     <div class="navbar bg-base-300 flex flex-col md:flex-row">
        <div class="flex-1">
            <a class="btn btn-ghost text-xl">Task Management</a>
        </div>
        <div class="flex-none">
            <ul class="menu menu-horizontal px-1">
                <template v-if="user">
                    <li> <router-link  class="bg-neutral-500 hover:bg-neutral-700 text-white font-bold py-2 px-4 rounded mr-1" :to="{name:'home'}">My Tasks</router-link></li>
                    <li> <router-link  class="bg-neutral-500 hover:bg-neutral-700 text-white font-bold py-2 px-4 rounded mr-1" :to="{name:'create'}">New Task</router-link></li>
                    <li> <router-link  class="bg-neutral-500 hover:bg-neutral-700 text-white font-bold py-2 px-4 rounded mr-1" :to="{name:'tokens'}">Api</router-link></li>
                    <li><a class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mr-1" @click="logout">Logout</a></li>
                </template>
                
                <template v-else>
                    <li> <router-link :to="{name:'login'}">Login</router-link></li>
                    <li> <router-link :to="{name:'register'}">Register</router-link></li>
                </template>
            </ul>
          
        </div>
    </div>
</template>

<script setup>
    import { useRouter } from 'vue-router';

    import { storeToRefs } from 'pinia';
    import { useUserStore } from '../stores/user';

    const userStore = useUserStore();
    const { user }=storeToRefs(userStore);
    const { updateUser }=userStore;

    const router=useRouter();

    const logout=async()=>{
        try
        {
            await axios.post('/logout');
            localStorage.removeItem('user');
            updateUser();
            router.push({name:'login'});
        }
        catch(error)
        {
            console.log('error',error)
        }
    }
</script>

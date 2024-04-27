<template>
     <div class="navbar bg-base-300 flex flex-col md:flex-row">
        <div class="flex-1">
            <a class="btn btn-ghost text-xl">Task Management</a>
        </div>
        <div class="flex-none">
            <ul class="menu menu-horizontal px-1">
                <template v-if="user">
                    <li> <router-link  class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-1" :to="{name:'home'}">My Tasks</router-link></li>
                    <li> <router-link  class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mr-1" :to="{name:'create'}">New Task</router-link></li>
                    <li> <router-link  class="bg-neutral-500 hover:bg-neutral-700 text-white font-bold py-2 px-4 rounded" :to="{name:'tokens'}">Tokens</router-link></li>
                </template>
                
                <template v-else>
                    <li> <router-link :to="{name:'login'}">Login</router-link></li>
                    <li> <router-link :to="{name:'register'}">Register</router-link></li>
                </template>
            </ul>
            <div class="dropdown dropdown-end" v-if="user">
                <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
                    <div class="w-10 rounded-full">
                        <img alt="Tailwind CSS Navbar component"
                            src="https://daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg" />
                    </div>
                </div>
                <ul tabindex="0"
                    class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
                    <li>
                        <a class="justify-between">
                            Profile
                        </a>
                    </li>
                    <li><a>Settings</a></li>
                    <li><a @click="logout">Logout</a></li>
                </ul>
            </div>
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

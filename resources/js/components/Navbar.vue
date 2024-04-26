<template>
     <div class="navbar bg-base-300">
        <div class="flex-1">
            <a class="btn btn-ghost text-xl">Task Management</a>
        </div>
        <div class="flex-none">
            <ul class="menu menu-horizontal px-1">
                <li v-if="isAuthenticated"> <router-link :to="{name:'home'}">Tasks</router-link></li>
                <template v-else>
                    <li> <router-link :to="{name:'login'}">Login</router-link></li>
                    <li> <router-link :to="{name:'register'}">Register</router-link></li>
                </template>
            </ul>
            <div class="dropdown dropdown-end" v-if="isAuthenticated">
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

    const isAuthenticated = localStorage.getItem('user');
    const router=useRouter();

    const logout=async()=>{
        try
        {
            await axios.post('/logout');
            localStorage.removeItem('user');
            router.push({name:'login'});
        }
        catch(error)
        {
            console.log('error',error)
        }
    }
</script>

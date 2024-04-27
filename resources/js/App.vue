<template>
    <div class="relative h-screen">
        <Navbar/>
        <div class="flex flex-col md:grid md:grid-cols-4 p-3 gap-1 max-h-72">
            <Sidebar class="col-span-1" v-if="user"/>
            <router-view></router-view>
        </div>
        <!-- <footer class="footer footer-center p-4 bg-base-300 text-base-content absolute bottom-0">
            <aside>
                <p>Copyright © 2024 - All right reserved by ACME Industries Ltd</p>
            </aside>
        </footer> -->
    </div>

</template>

<script setup>
import Navbar from './components/Navbar.vue';
import Sidebar from './components/Sidebar.vue';
import { useUserStore } from './stores/user';
import {storeToRefs} from 'pinia';

const { user }= storeToRefs(useUserStore());

</script>


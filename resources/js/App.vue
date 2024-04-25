<template>
    <div class="relative h-screen">
        <Navbar/>
        <router-view></router-view>
        <!-- <footer class="footer footer-center p-4 bg-base-300 text-base-content absolute bottom-0">
            <aside>
                <p>Copyright © 2024 - All right reserved by ACME Industries Ltd</p>
            </aside>
        </footer> -->
    </div>

</template>

<script setup>
import Navbar from './components/Navbar.vue';

</script>


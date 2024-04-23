<template>
    <nav>
        <router-link :to="{name:'home'}">Home link</router-link>
        <router-link :to="{name:'contact'}">Contact link</router-link>
    </nav>
    <div class="bg-slate-400">
        Yes 
        <router-view></router-view>
    </div>

</template>


<template>
     <div class="flex items-center justify-center mt-2" v-if="total > 5 && links.length">
            <button v-for="(link, index) in links" @click="getTasks(link.url)" :key="index" v-html="link.label"
                class="py-2 px-4 border border-slate-300 rounded"
                :class="{ 'bg-indigo-700 text-white shadow-sm': link.active }"></button>
        </div>
</template>

<script setup>
    import { useTaskStore } from '../stores/tasks';
    import { storeToRefs } from 'pinia';
    
    const taskStore = useTaskStore();

    const { getTasks } = taskStore;

    const { links, total } = storeToRefs(taskStore);
</script>


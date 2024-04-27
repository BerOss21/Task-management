<template>
    <div class="flex flex-col md:mx-auto gap-2 w-full">
        <div class="py-3 px-6 rounded-lg bg-gray-400 text-black hover:shadow-lg">
            <div class="flex flex-col gap-3">
                <h3 class="text-lg font-bold text-black">Total</h3>
                <span class="loading loading-dots loading-lg" v-if="loading_statistics"></span>
                <p v-else-if="statistics.total">{{ statistics.total }} Tasks</p>
                <p v-else="statistics.total">0 Tasks</p>
            </div>
        </div>
        <div class="py-3 px-6 rounded-lg bg-orange-400 text-black hover:shadow-lg">
            <div class="flex flex-col gap-3">
                <h3 class="text-lg font-bold text-black">In progress</h3>
                <span class="loading loading-dots loading-lg" v-if="loading_statistics"></span>
                <p v-else-if="statistics.in_progress">{{ statistics.in_progress }} Tasks</p>
                <p v-else="statistics.total">0 Tasks</p>
            </div>
        </div>
        <div class="py-3 px-6 rounded-lg bg-green-400 text-black hover:shadow-lg">
            <div class="flex flex-col gap-3">
                <h3 class="text-lg font-bold text-black">Completed</h3>
                <span class="loading loading-dots loading-lg" v-if="loading_statistics"></span>
                <p v-else-if="statistics.completed">{{ statistics.completed }} Tasks</p>
                <p v-else="statistics.total">0 Tasks</p>
            </div>
        </div>
    </div>
</template>

<script setup>
    import {onMounted} from 'vue';

    import { useStatisticStore } from '../stores/statistics';

    import {storeToRefs} from 'pinia';

    const store=useStatisticStore();

    const {statistics,loading_statistics} = storeToRefs(store);
    const { getStatistics } = store;


    onMounted(() => getStatistics() )
</script>
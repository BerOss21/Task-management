<template>
    <div class="flex flex-col md:mx-auto gap-2 w-full">
        <div class="py-3 px-6 rounded-lg bg-gray-400 text-black hover:shadow-lg">
            <div class="flex flex-col gap-3">
                <h3 class="text-lg font-bold text-black">Total</h3>
                <span class="loading loading-dots loading-lg" v-if="loading"></span>
                <p v-else>{{ statistics.total }} Tasks</p>
            </div>
        </div>
        <div class="py-3 px-6 rounded-lg bg-orange-400 text-black hover:shadow-lg">
            <div class="flex flex-col gap-3">
                <h3 class="text-lg font-bold text-black">Completed</h3>
                <span class="loading loading-dots loading-lg" v-if="loading"></span>
                <p v-else>{{ statistics.completed }} Tasks</p>
            </div>
        </div>
        <div class="py-3 px-6 rounded-lg bg-green-400 text-black hover:shadow-lg">
            <div class="flex flex-col gap-3">
                <h3 class="text-lg font-bold text-black">In progress</h3>
                <span class="loading loading-dots loading-lg" v-if="loading"></span>
                <p v-else>{{ statistics.in_progress }} Tasks</p>
            </div>
        </div>
     
    </div>
</template>

<script setup>
    import {reactive, ref, onMounted} from 'vue';

    const loading=ref(false);

    const statistics=reactive({
        total:null,
        completed:null,
        in_progress:null
    });

    onMounted(async()=>{
        loading.value=true;

        try{
            const response=await axios.get('/api/statistics');
            statistics.total=response.data.total;
            statistics.completed=response.data.completed;
            statistics.in_progress=response.data.in_progress;
        }
        catch(error){
            console.error('Error:', error);
        }
        finally{
            loading.value=false
        }
    })
</script>
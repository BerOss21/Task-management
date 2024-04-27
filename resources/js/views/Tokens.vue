<template>  
    <div class="bg-neutral-100 w-auto rounded-lg p-4 flex justify-center items-center col-span-3">
        <div class="text-center rounded-lg w-full p-3" v-if="loading">
            <div colspan="5" class="text-center">
                <span class="loading loading-dots loading-lg"></span>
            </div>
        </div>
        <div class="flex flex-col gap-2">
            <div class="text-center rounded-lg w-full p-3" v-if="access_token">
                <h2>{{ access_token }}</h2>
            </div>
            <div class="flex gap-1 mt-2 self-center" v-if="!loading">
                <button @click="generateNewToken"
                    class="btn bg-neutral-500 hover:bg-neutra text-white font-bold py-2 px-4 rounded">
                    Generate New Token
                </button>
                <button onclick="api_modal.showModal()"
                    class="btn bg-gray-400 hover:bg-gray-600 l-700 text-white font-bold py-2 px-4 rounded">
                    Api documentation
                </button>
            </div>
        </div>
    </div>

    <dialog id="api_modal" class="modal">
        <div class="modal-box space-y-2">
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
            </form>
            <h3 class="font-bold text-lg">Api documentation</h3>
            <ApiDoc />
        </div>
    </dialog>
</template>

<script setup>
import { ref, onMounted } from "vue";
import ApiDoc from '../components/ApiDoc.vue';

const loading = ref(false);

const access_token = ref(null);

const generateNewToken = async () => {
    loading.value = true;
    try {
        const response = await axios.post(route('tokens'));
        access_token.value = response.data;
    }
    catch (error) {
        console.error('Error fetching data:', error);
    }
    finally {
        loading.value = false
    }
}
</script>
<template>
    <div class="flex flex-col md:grid md:grid-cols-4 p-3 gap-1 max-h-72">
        <Sidebar class="col-span-1" />
        <div class="bg-base-100 md:col-span-3 w-full rounded-lg p-4">
            <div class="overflow-x-auto">
                <div class="flex flex-col">
                    <form @submit.prevent="createTask">
                        <div class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">
                            <div class="px-4 py-5 sm:px-6">
                                <h3 class="text-lg font-semibold mb-3">New Task</h3>
                                <input v-model="task.title" class="w-full border rounded px-3 py-2" placeholder="Title">
                                <textarea v-model="task.description" class="w-full border rounded px-3 py-2 mt-2"
                                    placeholder="Description"></textarea>
                                <select v-model="task.status" class="mt-2 block w-full border rounded px-3 py-2">
                                    <option :value="null" disabled selected>Status</option>
                                    <option value="completed">Completed</option>
                                    <option value="in progress">In Progress</option>
                                </select>
                                <input v-model="task.due_date" type="date"
                                    class="mt-2 block w-full border rounded px-3 py-2">
                            </div>
                        </div>
                        <div class="flex justify-end mt-4">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';

const router = useRouter();

import Sidebar from '../components/Sidebar.vue';

const task = ref({
    title: null,
    description: null,
    status: null,
    due_date: null
});

const createTask= async () => {
    try {
        await axios.post('/api/tasks', task.value);
        router.push({name:'home'})
    } catch (error) {
        console.error('Error creating task:', error);
    }
};
</script>

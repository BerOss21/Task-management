<template>
    <div class="flex flex-col md:grid md:grid-cols-4 p-3 gap-1 max-h-72">
        <Sidebar class="col-span-1" />
        <div v-if="task" class="bg-base-100 md:col-span-3 w-full rounded-lg p-4">
            <div class="overflow-x-auto">
                <div class="flex flex-col">
                    <div class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">
                        <div class="px-4 py-5 sm:px-6">
                            <template v-if="editing">
                                <input v-model="editedTask.title" class="w-full border rounded px-3 py-2">
                            </template>

                            <template v-else>
                                <h3 class="text-lg font-medium leading-6 text-gray-900">{{ task.title }}</h3>
                            </template>

                            <template v-if="editing">
                                <textarea v-model="editedTask.description"
                                    class="w-full border rounded px-3 py-2 mt-2"></textarea>
                            </template>

                            <template v-else>
                                <p class="mt-1 max-w-2xl text-sm text-gray-500">{{ task.description }}</p>
                            </template>
                        </div>
                        <div class="px-4 py-5 sm:px-6">
                            <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                                <div class="sm:col-span-1">

                                    <template v-if="editing">
                                        <label for="status"
                                            class="block text-sm font-medium text-gray-700">Status</label>
                                        <select v-model="editedTask.status" id="status"
                                            class="mt-1 block w-full pl-3 pr-10 py-2 border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                                            <option value="completed">Completed</option>
                                            <option value="in progress">In Progress</option>
                                        </select>
                                    </template>

                                    <template v-else>
                                        <dt class="text-sm font-medium text-gray-500">Status</dt>
                                        <dd class="mt-1 text-sm text-gray-900">{{ task.status.name }}</dd>
                                    </template>
                                </div>
                                <div class="sm:col-span-1">

                                    <template v-if="editing">
                                        <label for="dueDate" class="block text-sm font-medium text-gray-700">Due
                                            Date</label>
                                        <input v-model="editedTask.due_date" type="date" id="dueDate"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                    </template>

                                    <template v-else>
                                        <dt class="text-sm font-medium text-gray-500">Due Date</dt>
                                        <dd class="mt-1 text-sm text-gray-900">{{ task.due_date }}</dd>
                                    </template>
                                </div>
                            </dl>
                        </div>
                    </div>
                    <div class="flex justify-end mt-4" v-if="!editing">
                        <button @click="startEditing"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</button>
                    </div>
                    <div class="flex justify-end mt-4" v-else>
                        <button @click="cancelEditing"
                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mr-2">Cancel</button>
                        <button @click="submitChanges"
                            class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script setup>
import Sidebar from '../components/Sidebar.vue';
import { ref, onMounted, reactive } from 'vue';
import { useRoute } from 'vue-router';

axios.interceptors.request.use(config => {
    const token = '6|unLoosPc2dJcvBrbbNC5KVc4xa5xtbHC4bhQ7U5T3d58f5d0';
    config.headers.Authorization = `Bearer ${token}`;
    return config;
});


const task = ref(null);

const editedTask = reactive({
    title:null,
    description:null,
    due_date:null,
    status:null
});
const editing = ref(false);

onMounted(async () => {
    await fetchTaskDetails();
});

const fetchTaskDetails = async () => {
    const route = useRoute();
    const taskId = route.params.id;
    try {
        const response = await axios.get(`/api/tasks/${taskId}`);
        task.value = response.data;
        editedTask.title = task.value.title;
        editedTask.description = task.value.description
        editedTask.due_date = task.value.due_date
        editedTask.status = task.value.status.name
    } catch (error) {
        console.error('Error fetching task details:', error);
    }
};

const startEditing = () => {
    editing.value = true;
};

const cancelEditing = () => {
    editedTask.title = task.value.title;
    editedTask.description = task.value.description
    editedTask.due_date = task.value.due_date
    editedTask.status = task.value.status.name
    editing.value = false;
};

const submitChanges = async () => {
    try {
        const response = await axios.patch(`/api/tasks/${task.value.id}`, editedTask);
        alert('Task updated');
        task.value =response.data;
        editing.value = false;
    } catch (error) {
        console.error('Error updating task:', error);
    }
};
</script>

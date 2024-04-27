<template>
    <div class="flex flex-col md:grid md:grid-cols-4 p-3 gap-1 max-h-72">
        <Sidebar class="col-span-1" />
        <div class="bg-base-100 md:col-span-3 w-full rounded-lg p-4">
            <div v-if="loading" class="h-full p-5 rounded-lg bg-neutral-100 flex justify-center items-center">
                <span class="loading loading-dots loading-lg"></span>
            </div>
            <div class="overflow-x-auto" v-else-if="task">
                <div class="flex flex-col">
                    <div class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">
                        <div class="px-4 py-5 sm:px-6">
                            <template v-if="editing">
                                <input v-model="form.title" class="w-full border rounded px-3 py-2">
                                <div class="text-red-600" v-if="errors.title">
                                        {{ errors.title }}
                                </div>
                                <div class="text-red-600" v-else-if="form.invalid('title')">
                                    {{ form.errors.title }}
                                </div>
                            </template>

                            <template v-else>
                                <h3 class="text-lg font-medium leading-6 text-gray-900">{{ task.title }}</h3>
                            </template>

                            <template v-if="editing">
                                <textarea v-model="form.description"
                                placeholder="Description"
                                    class="w-full border rounded px-3 py-2 mt-2"></textarea>
                                <div class="text-red-600" v-if="errors.description">
                                    {{ errors.description }}
                                </div>
                                <div class="text-red-600" v-else-if="form.invalid('description')">
                                    {{ form.errors.description }}
                                </div>
                            </template>

                            <div class="h-28 overflow-auto border mt-2 rounded-lg p-1" v-else>
                                <p class="mt-1 max-w-2xl text-sm text-gray-500">{{ task.description }}</p>
                            </div>
                        </div>
                        <div class="px-4 py-5 sm:px-6">
                            <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                                <div class="sm:col-span-1">

                                    <template v-if="editing">
                                        <label for="status"
                                            class="block text-sm font-medium text-gray-700">Status</label>
                                        <select v-model="form.status" id="status"
                                            class="mt-1 block w-full pl-3 pr-10 py-2 border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                                            <option value="completed">Completed</option>
                                            <option value="in progress">In Progress</option>
                                        </select>
                                        <div class="text-red-600" v-if="errors.status">
                                            {{ errors.status }}
                                        </div>
                                        <div class="text-red-600" v-else-if="form.invalid('status')">
                                            {{ form.errors.status }}
                                        </div>
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
                                        <input v-model="form.due_date" type="date" id="dueDate"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                            <div class="text-red-600" v-if="errors.due_date">
                                                {{ errors.due_date }}
                                            </div>
                                            <div  class="text-red-600" v-else-if="form.invalid('due_date')">
                                                {{ form.errors.due_date }}
                                            </div>
                                    </template>

                                    <template v-else>
                                        <dt class="text-sm font-medium text-gray-500">Due Date</dt>
                                        <dd class="mt-1 text-sm text-gray-900">{{ task.due_date.dmy }}</dd>
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
            <div v-else class="h-full p-5 rounded-lg bg-neutral-100 flex justify-center items-center">
                <p>task not avaible</p>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted} from 'vue';
import { useRoute } from 'vue-router';
import { useForm } from 'laravel-precognition-vue';
import Sidebar from '../components/Sidebar.vue';
import useValidation from "../services/validation";

const {errors, validateEditForm} = useValidation();

const route = useRoute();

const task = ref(null);

const loading= ref(false);

const form = useForm('patch', `/api/tasks/${route.params.id}`, {
    title: null,
    description: null,
    status: null,
    due_date: null
});

const editing = ref(false);

onMounted(async () => {
    loading.value=true;
    try {
        const response = await axios.get(`/api/tasks/${route.params.id}`);
        task.value = response.data;
    } 
    
    catch (error) {
        console.error('Error fetching task details:', error);
    }

    finally{
        loading.value=false
    }
});

const startEditing = () => {
    form.title = task.value.title;
    form.description = task.value.description
    form.due_date = task.value.due_date.ymd
    form.status = task.value.status.name
    editing.value = true
};

const cancelEditing = () => {
    form.title = task.value.title;
    form.description = task.value.description
    form.due_date = task.value.due_date.ymd
    form.status = task.value.status.name
    editing.value = false;
    errors.value={};
};

const submitChanges = async () => {
    if(validateEditForm(form))
    {
        errors.value={};

        loading.value=true;
        
        try {
            const response= await form.submit();
            editing.value = false;
            task.value =response.data;
        } 
        
        catch (error) {
            console.error('Error creating task:', error);
        }

        finally{
            loading.value=false
        }
    }
};
</script>

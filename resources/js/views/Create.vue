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

                                <div class="form-control">
                                    <input v-model="form.title" class="w-full border rounded px-3 py-2" placeholder="Title">
                                    <div class="text-red-600" v-if="errors.title">
                                        {{ errors.title }}
                                    </div>
                                    <div class="text-red-600" v-else-if="form.invalid('title')">
                                        {{ form.errors.title }}
                                    </div>
                                </div>

                                <div class="form-control">
                                    <textarea v-model="form.description" class="w-full border rounded px-3 py-2 mt-2"
                                        placeholder="Description"></textarea>
                                    <div class="text-red-600" v-if="errors.description">
                                        {{ errors.description }}
                                    </div>
                                    <div class="text-red-600" v-else-if="form.invalid('description')">
                                        {{ form.errors.description }}
                                    </div>
                                </div>
                                <div class="form-control">
                                    <select v-model="form.status" class="mt-2 block w-full border rounded px-3 py-2">
                                        <option :value="null" disabled selected>Status</option>
                                        <option value="completed">Completed</option>
                                        <option value="in progress">In Progress</option>
                                    </select>
                                    <div class="text-red-600" v-if="errors.status">
                                        {{ errors.status }}
                                    </div>
                                    <div class="text-red-600" v-else-if="form.invalid('status')">
                                        {{ form.errors.status }}
                                    </div>
                                </div>
                                <div>
                                    <input v-model="form.due_date" type="date"
                                    class="mt-2 block w-full border rounded px-3 py-2">
                                    <div class="text-red-600" v-if="errors.due_date">
                                        {{ errors.due_date }}
                                    </div>
                                    <div  class="text-red-600" v-else-if="form.invalid('due_date')">
                                        {{ form.errors.due_date }}
                                    </div>
                                </div>
                                
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
import { useForm } from 'laravel-precognition-vue';
import useValidation from "../services/validation";


const {errors, validateCreateForm} = useValidation();

const router = useRouter();

import Sidebar from '../components/Sidebar.vue';

const form = useForm('post', '/api/tasks', {
    title: null,
    description: null,
    status: null,
    due_date: null
});

const createTask= async () => {
    if(validateCreateForm(form))
    {
        errors.value={}

        try {
            await form.submit();
            router.push({name:'home'})
        } catch (error) {
            console.error('Error creating task:', error);
        }
    }
};
</script>

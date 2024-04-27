<template>
    <div class="overflow-x-auto">
        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Due date</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr class="bg-neutral-100 text-center rounded-lg w-full p-3" v-if="loading">
                    <td colspan="5" class="text-center">
                        <span class="loading loading-dots loading-lg"></span>
                    </td>
                </tr>
                <template v-else-if="tasks.length">
                    <tr v-for="(row, index) in tasks" :key="index" class="hover">
                        <td>{{ row.title }}</td>
                        <td>{{ row.description_preview }}</td>
                        <td>{{ row.due_date.dmy }}</td>
                        <td>{{ row.status.name }}</td>
                        <td class="flex gap-1">
                            <router-link :to="{ name: 'detail', params: { id: row.id } }"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Show</router-link>
                            <button @click="removeTask(row.id)" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>
                        </td>
                    </tr>
                </template>
                <tr class="bg-neutral-100 text-center rounded-lg w-full p-3" v-else>
                    <td colspan="5" class="text-center">No tasks found</td>
                </tr>
            </tbody>  
        </table>
    </div>
</template>

<script setup>
  import {  onMounted, watch } from 'vue';
  import { storeToRefs } from 'pinia';
  import { useTaskStore } from '../stores/tasks';
  import { useFilterStore } from '../stores/filters';
  import { debounce, filter } from 'lodash';

  const taskStore = useTaskStore();
  const filterStore = useFilterStore();

  const { tasks, loading } = storeToRefs(taskStore);
  const { sort, filters } = storeToRefs(filterStore);

  const { getTasks, deleteTask } = taskStore;

  const removeTask=(id)=>{
    if(confirm('Delete this task ?'))
    {
        deleteTask(id, sort.value, filters.value);
    }
  }

  onMounted(async () => await getTasks('/api/tasks',{ sort:sort.value, filters:filters.value }));
  
  watch(()=>sort, debounce(() => { getTasks('/api/tasks', { sort:sort.value, filters:filters.value }) }, 500),{deep:true})

</script>
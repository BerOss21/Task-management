<template>
    <div class="overflow-x-auto">
        <table class="table" v-if="tasks.length">
            <thead>
                <tr>
                    <th class="cursor-pointer" @click="sortBy('title')">Title <span v-if="sort.field === 'title'"><i
                                class="fas fa-sort-{{ sort.direction }}"></i></span></th>
                    <th>Description</th>
                    <th @click="sortBy('due_date')">Due date <span v-if="sort.field === 'due_date'"><i
                                class="fas fa-sort-{{ sort.direction }}"></i></span></th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(row, index) in tasks" :key="index" class="hover">
                    <td>{{ row.title }}</td>
                    <td>{{ row.description_preview }}</td>
                    <td>{{ row.due_date.dmy }}</td>
                    <td>{{ row.status.name }}</td>
                    <td>
                        <router-link :to="{ name: 'detail', params: { id: row.id } }"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Detail</router-link>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="bg-neutral-100 text-center rounded-lg w-full p-3" v-else>
            No tasks found
        </div>
    </div>
</template>

<script setup>
  import {  onMounted, watch } from 'vue';
  import { storeToRefs } from 'pinia';
  import { useTaskStore } from '../stores/tasks';
  import { useFilterStore } from '../stores/filters';
  import { debounce } from 'lodash';

  const taskStore = useTaskStore();
  const filterStore = useFilterStore();

  const { tasks,total } = storeToRefs(taskStore);
  const { sort, filters } = storeToRefs(filterStore);

  const { getTasks } = taskStore;

  onMounted(async () => await getTasks('/api/tasks'));
  
  const sortBy = (field) => sort.value[field] = sort.value[field] === 'desc' ? 'asc' : 'desc';

  watch(()=>sort, debounce(() => { getTasks('/api/tasks', { sort:sort.value, filters:filters.value }) }, 500),{deep:true})

</script>
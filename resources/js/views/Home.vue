<template>
    <div class="bg-base-100 md:col-span-3 w-full rounded-lg p-4">
      <div class="bg-base-200 shadow-md rounded-md flex flex-col md:flex-row gap-2 mb-4 p-1">
        <label class="input input-bordered flex items-center gap-2">
          <input type="text" v-model="filters.title" class="grow" placeholder="Filter by Title" />
        </label>
        <select class="select w-full max-w-xs" v-model="filters.status" >
          <option disabled selected :value="null">Pick your favorite Simpson</option>
          <option value="in progress">In progress</option>
          <option value="completed">Completed</option>
        </select>
        <label class="input input-bordered flex items-center gap-2">
          <input type="date" v-model="filters.due_date" class="grow" placeholder="Filter by Due Date" />
        </label>
      </div>
      <div class="overflow-x-auto">
        <table class="table" v-if="total">
          <thead>
            <tr>
              <th class="cursor-pointer" @click="sortBy('title')">Title <span v-if="sort.field === 'title'"><i class="fas fa-sort-{{ sort.direction }}"></i></span></th>
              <th>Description</th>
              <th @click="sortBy('due_date')">Due date <span v-if="sort.field === 'due_date'"><i class="fas fa-sort-{{ sort.direction }}"></i></span></th>
              <th>Status</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(row, index) in tasks" :key="index" class="hover">
              <td>{{ row.title }}</td>
              <td>{{ row.description_preview }}</td>
              <td>{{ row.due_date }}</td>
              <td>{{ row.status.name }}</td>
              <td>
                <router-link :to="{ name: 'detail', params: { id: row.id }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Detail</router-link>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="flex items-center justify-center mt-2" v-if="total>5 && links.length">
          <button v-for="(link,index) in links" @click="fetchData(link.url)" :key="index" v-html="link.label" 
          class="py-2 px-4 border border-slate-300 rounded"
          :class="{'bg-indigo-700 text-white shadow-sm':link.active}"
          ></button>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted, computed, reactive, watch } from 'vue';
  import {debounce} from 'lodash';
  
  const tasks = ref([]);
  const links = ref([]);
  const total = ref(5);
  const filters = reactive({ title: null, status: null, due_date: null });
  const sort = reactive({ title: 'desc', dueDate: 'desc' });
  
  onMounted(async () => {
    await fetchData('/api/tasks');
  });
  
  axios.interceptors.request.use(config => {
    const token = '6|unLoosPc2dJcvBrbbNC5KVc4xa5xtbHC4bhQ7U5T3d58f5d0';
    config.headers.Authorization = `Bearer ${token}`;
    return config;
  });
  
  const fetchData = async (url,query={}) => {
    try {
      const response = await axios.get(url,{params:query});
      tasks.value = response.data.data;
      links.value = response.data.meta.links;
      total.value = response.data.meta.total;
    } catch (error) {
      console.error('Error fetching data:', error);
    }
  };
  
  
  const sortBy = (field) => {
    sort[field] = sort[field] === 'desc' ? 'asc' : 'desc';
  };
  
  watch(sort,debounce(()=>{fetchData('/api/tasks',{sort,filters})},500))
  
  watch(filters,debounce(()=>{fetchData('/api/tasks',{sort,filters})},500))
  </script>
  
  
<template>
    <div class="bg-base-100 md:col-span-3 w-full rounded-lg p-4">
      <div class="overflow-x-auto">
        <table class="table">
          <thead>
            <tr>
              <th></th>
              <th>Title</th>
              <th>Description</th>
              <th>Status</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(row, index) in data" :key="index" class="hover">
              <th>{{ index + 1 }}</th>
              <td>{{ row.title }}</td>
              <td>{{ row.description_preview }}</td>
              <td>{{ row.status.name }}</td>
              <td>
                <router-link :to="{ name: 'detail', params: { id: row.id }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Detail</router-link>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted } from 'vue';
  import axios from 'axios';
  import { useRoute } from 'vue-router';
  
  const data = ref([]);
  
  onMounted(async () => {
    await fetchData();
  });
  
  axios.interceptors.request.use(config => {
  const token = '6|unLoosPc2dJcvBrbbNC5KVc4xa5xtbHC4bhQ7U5T3d58f5d0';
  config.headers.Authorization = `Bearer ${token}`;
  return config;
});

  const fetchData = async () => {
    try {
      const response = await axios.get('/api/tasks');
      data.value = response.data;
    } catch (error) {
      console.error('Error fetching data:', error);
    }
  };
  </script>
  
  <style>
  /* Add your styles here */
  </style>
  
import { defineStore } from 'pinia';
import { ref } from 'vue';

export const useTaskStore = defineStore('tasks', () => {
    axios.interceptors.request.use(config => {
        const token = '6|unLoosPc2dJcvBrbbNC5KVc4xa5xtbHC4bhQ7U5T3d58f5d0';
        config.headers.Authorization = `Bearer ${token}`;
        return config;
    });
    
    const task = ref(null);
    const tasks = ref([]);
    const total = ref(0);
    const links = ref([]);

    const getTasks = async (url, params= {}) => {
        try {
            const response = await axios.get(url, { params });
            tasks.value = response.data.data;
            links.value = response.data.meta.links;
            total.value = response.data.meta.total;
        } 
        catch (error) {
            console.error('Error fetching data:', error);
        }
    }

    const getSingleTask=async (taskId ) => {
        try {
            const response = await axios.get(`/api/tasks/${taskId}`);
            task.value = response.data;
        } catch (error) {
            console.error('Error fetching task details:', error);
        }
    };

    const updateTask=async (data) => {
        try {
            const response = await axios.patch(`/api/tasks/${task.value.id}`, data);
            task.value =response.data;
        } catch (error) {
            console.error('Error updating task:', error);
        }
    };

    const deleteTask=async (taskId) => {
        try {
            const response = await axios.delete(`/api/tasks/${taskId}`);
        } catch (error) {
            console.error('Error updating task:', error);
        }
    };
    
    return {
        task,
        tasks,
        total,
        links,
        getTasks,
        getSingleTask,
        updateTask,
        deleteTask
    }
})
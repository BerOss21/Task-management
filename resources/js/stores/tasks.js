import { defineStore } from 'pinia';
import { ref } from 'vue';

export const useTaskStore = defineStore('tasks', () => {
    const tasks = ref([]);
    const total = ref(0);
    const links = ref([]);
    const statistics = ref([]);
    const loading=ref(false);

    const getTasks = async (url, params= {}) => {

        loading.value=true;

        try {
            const response = await axios.get(url, { params });
            tasks.value = response.data.data;
            links.value = response.data.meta.links;
            total.value = response.data.meta.total;
            statistics.value = response.data.statistics;
        } 
        catch (error) {
            console.error('Error fetching data:', error);
        }
        finally{
            loading.value=false
        }
    }

    const deleteTask=async (taskId,sort, filters) => {   
        loading.value=true;

        try {
            await axios.delete(`/api/tasks/${taskId}`);
            await getTasks('/api/tasks',{ sort:sort, filters:filters });
        } 
        catch (error) {
            console.error('Error updating task:', error);
        }
        finally{
            loading.value=false
        }
    };
    
    return {
        tasks,
        total,
        links,
        statistics,
        loading,
        getTasks,
        deleteTask
    }
})
import { defineStore } from 'pinia';
import { ref } from 'vue';

export const useTaskStore = defineStore('tasks', () => {
    // const task = ref(null);
    const tasks = ref([]);
    const total = ref(0);
    const links = ref([]);
    const loading=ref(false);

    const getTasks = async (url, params= {}) => {

        loading.value=true;

        try {
            const response = await axios.get(url, { params });
            tasks.value = response.data.data;
            links.value = response.data.meta.links;
            total.value = response.data.meta.total;
        } 
        catch (error) {
            console.error('Error fetching data:', error);
        }
        finally{
            loading.value=false
        }
    }

    // const getSingleTask=async (taskId ) => {        
    //     try {
    //         const response = await axios.get(`/api/tasks/${taskId}`);
    //         task.value = response.data;
    //     } catch (error) {
    //         console.error('Error fetching task details:', error);
    //     }
    // };

    // const updateTask=async (data) => {
    //     try {
    //         const response = await axios.patch(`/api/tasks/${task.value.id}`, data);
    //         task.value =response.data;
    //     } catch (error) {
    //         console.error('Error updating task:', error);
    //     }
    // };

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
        // task,
        tasks,
        total,
        links,
        loading,
        getTasks,
        // getSingleTask,
        // updateTask,
        deleteTask
    }
})
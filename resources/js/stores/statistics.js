import { defineStore } from 'pinia';
import { ref } from 'vue';

export const useStatisticStore = defineStore('statistics', () => {
    const statistics = ref([]);

    const loading_statistics=ref(false);
    
    const getStatistics=async()=>{
        loading_statistics.value=true;
        try{
            const response= await axios.get('/api/statistics');
            statistics.value=response.data;
        }
        catch(error)
        {
            console.log('Error: ',error);
        }
        finally{
            loading_statistics.value=false;
        }
    }

    return {
        statistics,
        loading_statistics,
        getStatistics
    }
})
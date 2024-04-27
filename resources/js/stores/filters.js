import { defineStore } from 'pinia';
import { reactive } from 'vue';

export const useFilterStore = defineStore('filter', () => {
    const filters = reactive({ title: null, status: null, due_date: null });
    const sort = reactive({ title: null, due_date: null });

    const resetFilters=()=>{
        filters.title=null;
        filters.status=null;
        filters.due_date=null;
        sort.title=null;
        sort.due_date=null;
    }

    return {
        filters,
        sort,
        resetFilters
    }
})
<template>
    <div class="bg-base-200 shadow-md rounded-md flex flex-col md:flex-row gap-2 mb-4 p-1">
        <label class="input input-bordered flex items-center gap-2">
            <input type="text" v-model="filters.title" class="grow" placeholder="Filter by Title" />
        </label>
        <select class="select w-full max-w-xs" v-model="filters.status">
            <option selected :value="null">All</option>
            <option value="in progress">In progress</option>
            <option value="completed">Completed</option>
        </select>
        <label class="input input-bordered flex items-center gap-2">
            <input type="date" v-model="filters.due_date" class="grow" placeholder="Filter by Due Date" />
        </label>
    </div>
</template>

<script setup>
    import { watch } from 'vue';
    import { useTaskStore } from '../stores/tasks';
    import { useFilterStore } from '../stores/filters';
    import { debounce } from 'lodash';
    // import { storeToRefs } from 'pinia';

    const taskStore = useTaskStore();

    const filterStore = useFilterStore();

    // const {sort,filters}=storeToRefs(filterStore);

    const { getTasks } = taskStore;
    const { sort,filters } = filterStore;
    watch(filters, debounce(async (val) => {
        await getTasks('/api/tasks', { sort, filters}) }, 500)
    )
</script>


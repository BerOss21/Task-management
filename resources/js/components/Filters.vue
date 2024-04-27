<template>
    <div class="flex flex-col md:flex-row gap-2">
        <div class="bg-base-200 md:w-4/6 shadow-md rounded-md p-2 space-y-2 mb-3 w-full">
            <h3>Filters</h3>
            <div class="flex flex-col md:flex-row gap-2">
                <label class="input input-bordered input-sm flex items-center gap-2">
                    <input type="text" v-model="filters.title" class="grow" placeholder="Title" />
                </label>
                <select class="select w-full max-w-xs select-sm" v-model="filters.status">
                    <option selected :value="null">All status</option>
                    <option value="in progress">In progress</option>
                    <option value="completed">Completed</option>
                </select>
                <label class="input input-sm input-bordered flex items-center gap-2 ">
                    <small class="text-xs text-nowrap">Due date</small>
                    <input type="date" v-model="filters.due_date"  />
                </label>
            </div>
        </div>

        <div class="bg-base-200 md:w-2/6 shadow-md rounded-md p-2 space-y-2 mb-3 w-full">
            <h3>Sort by</h3>
            <div class="flex flex-col md:flex-row gap-2">
                <label class="form-control w-full max-w-xs">
                    <select class="select select-sm" v-model="sort.title">
                        <option :value="null">Title (-)</option>
                        <option value="desc">Title (desc)</option>
                        <option value="asc">Title (asc)</option>
                    </select>
                </label>
                <label class="form-control w-full max-w-xs">
                    <select class="select select-sm" v-model="sort.due_date">
                        <option :value="null">Due date (-)</option>
                        <option value="desc">Due date (desc)</option>
                        <option value="asc">Due date (asc)</option>
                    </select>
                </label>
            </div>
        </div>
    </div>

</template>

<script setup>
import { watch } from 'vue';
import { useTaskStore } from '../stores/tasks';
import { useFilterStore } from '../stores/filters';
import { debounce } from 'lodash';

const taskStore = useTaskStore();

const filterStore = useFilterStore();

const { getTasks } = taskStore;
const { sort, filters } = filterStore;

watch(filters, debounce(async () => {
    await getTasks(route('tasks.index'), { sort, filters })
}, 500))
</script>

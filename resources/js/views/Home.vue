<template>
    <div class="flex flex-col md:grid md:grid-cols-4 p-3 gap-1 max-h-72">
        <Sidebar class="col-span-1" />
        <div class="bg-base-100 md:col-span-3 w-full rounded-lg p-4">
            <Filters />
            <Datatable />
            <Pagination />
        </div>
    </div>

</template>

<script setup>
import Filters from '../components/Filters.vue';
import Pagination from '../components/Pagination.vue';
import Datatable from '../components/Datatable.vue';
import Sidebar from '../components/Sidebar.vue';
</script>
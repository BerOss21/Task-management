<template>
    <div class="bg-base-100 md:col-span-3 w-full rounded-lg p-4">
        <Filters/>
        <Datatable/>
        <Pagination/>
    </div>
</template>

<script setup>
    import Filters from '../components/Filters.vue';
    import Pagination from '../components/Pagination.vue';
    import Datatable from '../components/Datatable.vue';
</script>
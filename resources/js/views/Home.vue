<template>
    <div class="flex flex-col md:grid md:grid-cols-4 p-3 gap-1 max-h-72">
        <Sidebar class="col-span-1" />
        <Datatable />
    </div>

</template>

<script setup>
import Sidebar from "../components/Sidebar.vue";
import Datatable from "../components/Datatable.vue";
</script>

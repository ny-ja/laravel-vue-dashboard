<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { ref } from 'vue';
import draggable from 'vuedraggable';

const meals = ref(['Hamburger', 'Pizza', 'Spaghetti', 'Tacos', 'Teriyaki Chicken']);
</script>

<template>
    <AdminLayout title="Playground">
        <!-- Main content header -->
        <div
            class="flex flex-col text-white cursor-pointer items-start justify-between pb-6 space-y-4 border-b lg:items-center lg:space-y-0 lg:flex-row dark:border-gray-600">
            <h1>Favorite Foods</h1>
            <draggable v-model="meals" tag="ul">
                <template #item="{ element: meal }">
                    <li>{{ meal }}</li>
                </template>
            </draggable>
        </div>
    </AdminLayout>
</template>
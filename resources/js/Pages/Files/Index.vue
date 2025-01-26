<template>
    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    Files
                </h2>
                <Link
                    :href="route('files.create')"
                    class="px-4 py-2 text-white bg-green-500 rounded-full"
                >
                    <i class="fas fa-plus"></i>
                </Link>
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h1 class="text-xl font-semibold">Owned Files</h1>
                        <FilesTable
                            class="mt-4"
                            :files="files"
                            :canDelete="true"
                        />

                        <hr class="my-4" />

                        <h1 class="mt-4 text-xl font-semibold">Shared Files</h1>
                        <FilesTable
                            class="mt-4"
                            :files="sharedFiles"
                            :canDelete="false"
                        />
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Link } from '@inertiajs/vue3';
import FilesTable from '@/Components/FilesTable.vue';

defineProps({
    files: Array,
    sharedFiles: Array,
});

</script>

<style scoped></style>

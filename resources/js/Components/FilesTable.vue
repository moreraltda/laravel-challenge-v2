<template>
    <table class="w-full">
        <thead>
            <tr>
                <th class="text-left">Title</th>
                <th class="text-left">Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr
                v-for="file in files"
                :key="file.id"
                :class="{
                    'bg-white': file.id % 2 === 0,
                    'bg-gray-200': file.id % 2 !== 0,
                }"
            >
                <td class="py-2 pl-2">{{ file.title }}</td>
                <td class="py-2 text-right">
                    <Link
                        :href="route('files.show', file.id)"
                        :active="route().current('files.index')"
                        class="px-4 py-2 text-white bg-blue-500 rounded"
                        ><i class="fas fa-eye"></i
                    ></Link>
                    <Link
                        :href="route('files.edit', file.id)"
                        :active="route().current('files.index')"
                        class="px-4 py-2 ml-2 text-white bg-green-500 rounded"
                        ><i class="fas fa-edit"></i
                    ></Link>
                    <button
                        v-if="canDelete"
                        @click="deleteFile(file)"
                        class="px-4 py-2 ml-2 text-white bg-red-500 rounded"
                    >
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            </tr>
        </tbody>
    </table>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import { Inertia } from '@inertiajs/inertia';

defineProps({
    files: {
        type: Array,
        required: true,
        default: false,
    },
    canDelete: {
        type: Boolean,
        required: true,
        default: false,
    },
});

const deleteFile = (file) => {
    if (confirm('Are you sure you want to delete this file?')) {
        Inertia.delete(route('files.destroy', file.id));
    }
};
</script>

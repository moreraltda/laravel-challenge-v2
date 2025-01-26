<template>
    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    File #{{ file.id }}
                </h2>
                <div class="flex items-center">
                    <Link
                        :href="route('files.edit', file.id)"
                        class="ml-4 text-green-500"
                        ><div class="fas fa-edit"></div
                    ></Link>
                    <Link
                        :href="route('files.index')"
                        class="ml-4 text-blue-500"
                        >Back</Link
                    >
                </div>
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h1 class="text-xl font-semibold">{{ file.title }}</h1>
                    </div>

                    <div class="flex">
                        <div
                            class="flex-1 p-6 bg-white border-b border-gray-200"
                        >
                            <h2 class="text-lg font-semibold">Owned by:</h2>
                            <p>{{ file.owner.name }}</p>
                        </div>
                    </div>

                    <div class="p-6 bg-white border-b border-gray-200">
                        {{ file.content }}
                    </div>
                </div>
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h2 class="text-lg font-semibold">
                            Share this file with an User:
                        </h2>
                        <input
                            type="text"
                            v-model="searchUser"
                            class="block w-full mt-1 form-input"
                            placeholder="Search user..."
                        />
                        <div
                            v-if="searchUser"
                            class="absolute z-10 w-1/2 mt-1 bg-white divide-y divide-gray-100 rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                        >
                            <ul
                                class="py-1 text-sm text-gray-700 dark:text-gray-700"
                                aria-labelledby="listbox-label"
                            >
                                <li
                                    v-for="user in filteredUsers"
                                    :key="user.id"
                                    class="px-4 py-2 cursor-pointer hover:bg-gray-100 hover:text-gray-900"
                                >
                                    <button @click="selectUser(user)">
                                        {{ user.name }}
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <h2 class="text-lg font-semibold">Shared with:</h2>
                    <table v-if="file.users.length > 0" class="w-full mt-4">
                        <thead>
                            <tr>
                                <th class="text-left">Name</th>
                                <th class="text-left">Email</th>
                                <th class="text-left">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="user in file.users" :key="user.id">
                                <td>{{ user.name }}</td>
                                <td>{{ user.email }}</td>
                                <td>
                                    <button
                                        @click="detachUser(user)"
                                        class="text-red-500"
                                    >
                                        Detach
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <p v-else>File is not shared with anyone.</p>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Link } from '@inertiajs/vue3';
import { ref, computed, onMounted } from 'vue';
import { Inertia } from '@inertiajs/inertia';

const searchUser = ref('');
const filteredUsers = computed(() => {
    return props.users.filter((user) =>
        user.name.toLowerCase().includes(searchUser.value.toLowerCase()),
    );
});

const selectUser = (user) => {
    Inertia.put(
        route('files.attach', {
            file: props.file.id,
            user: user.id,
        }),
    );
};

const detachUser = (user) => {
    Inertia.put(
        route('files.detach', {
            file: props.file.id,
            user: user.id,
        }),
    );
};

const props = defineProps({
    file: Object,
    users: Array,
});

onMounted(() => {
    Echo.channel('file-change').listen('FileChangeEvent', (e) => {
        Inertia.get(route('files.show', { file: e.file.id }));
    });
});
</script>

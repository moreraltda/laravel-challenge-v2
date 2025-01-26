<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div
        class="flex flex-col items-center min-h-screen bg-gray-100 sm:pt-0"
    >
        <div>
            <Link href="/">
                <ApplicationLogo class="w-20 h-20 text-gray-500 fill-current" />
            </Link>
        </div>

        <div
            class="w-full px-6 py-4 mt-6 overflow-hidden bg-white shadow-md sm:max-w-4xl sm:rounded-lg"
        >
            <slot />
        </div>
    </div>
</template>

<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { ProductResponse } from '@/types';

defineProps<{
    meta: ProductResponse['meta']
}>();
</script>

<template>
    <nav class="flex items-center flex-column flex-wrap md:flex-row justify-between py-2 px-4"
        aria-label="Table navigation">
        <span class="text-sm font-normal text-gray-700 mb-4 md:mb-0 block w-full md:inline md:w-auto">Showing
            <span class="font-semibold text-gray-700">{{ meta.from }}-{{ meta.to }}</span> of <span
                class="font-semibold text-gray-700">{{ meta.total }}</span></span>
        <ul class="inline-flex -space-x-px rtl:space-x-reverse text-sm h-8">
            <li v-for="(link, index) in meta.links" :key="index">
                <Link :href="link.url ?? ''" class="flex items-center justify-center px-3 h-8 ms-0" :class="{
                    'leading-tight text-gray-500 hover:text-gray-700': !link.active,
                    'text-blue-600 hover:text-blue-700': link.active,
                    'text-stone-400 hover:text-stone-400': !link.url
                }" v-html="link.label" preserve-scroll />
            </li>
        </ul>
    </nav>
</template>
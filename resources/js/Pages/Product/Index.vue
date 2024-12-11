<script setup lang="ts">
import { ref } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { ProductResponse } from '@/types';

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import ConfirmationDialog from '@/Components/ConfirmationDialog.vue';
import TablePagination from '@/Components/TablePagination.vue';

defineProps<{
    products: ProductResponse
    query?: {
        search: string
    }
}>();

const isDialogOpen = ref<boolean>(false);
const selectedProductId = ref<number>();

const handleDelete = () => {
    router.delete(route('products.destroy', selectedProductId.value), {
        preserveScroll: true,
        onFinish: () => {
            isDialogOpen.value = false
            selectedProductId.value = undefined
        }
    })
}

const handleSearch = (event: KeyboardEvent) => {
    const target = event.target as HTMLInputElement

    router.get(route("products.index", {
        search: target.value
    }))
}
</script>

<template>

    <Head title="Product" />

    <ConfirmationDialog :is-open="isDialogOpen" title="Are you sure ?" message="This action can't be undone."
        @confirm="handleDelete" @cancel="isDialogOpen = false" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    Product
                </h2>

                <Link :href="route('products.create')"
                    class="px-3 py-2.5 text-sm font-medium text-center text-white bg-blue-700 rounded-md hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                New
                Product</Link>
            </div>
        </template>

        <div class="py-6">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="flex flex-column sm:flex-row flex-wrap space-y-4 sm:space-y-0 items-center justify-end pb-6">
                    <div class="relative">
                        <div
                            class="absolute inset-y-0 left-0 rtl:inset-r-0 rtl:right-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-500" aria-hidden="true" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <input type="text" id="table-search" @keydown.enter="handleSearch" :value="query?.search ?? ''"
                            class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Search for items">
                    </div>
                </div>
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full    text-sm text-left rtl:text-right text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    No
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Product name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Category
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Price
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Weight
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(product, index) in products.data" :key="product.id"
                                class="bg-white border-b hover:bg-gray-50">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ products.meta.from + index }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ product.name }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ product.category.name }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ product.price_formatted }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ product.weight }}
                                </td>
                                <td class="px-6 py-4 space-x-2">
                                    <Link :href="route('products.show', product.id)"
                                        class="font-medium text-gray-600 hover:underline">Show</Link>
                                    <Link :href="route('products.edit', product.id)"
                                        class="font-medium text-blue-600 hover:underline">Edit</Link>
                                    <button @click="isDialogOpen = true, selectedProductId = product.id"
                                        class="font-medium text-red-600 hover:underline">
                                        Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <TablePagination :meta="products.meta" />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

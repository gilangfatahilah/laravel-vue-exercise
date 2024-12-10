<script setup lang="ts">
import { ref } from 'vue';
import { Head, Link, router, useForm } from '@inertiajs/vue3';
import { Product } from '@/types';

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { default as ProductForm } from "@/Components/Forms/Product.vue"
import ConfirmationDialog from '@/Components/ConfirmationDialog.vue';

const { categories, product } = defineProps<{
    categories: Product['category'][]
    product: Product
}>();

const form = useForm({
    ...product,
    category_id: product.category.id
});

const isDialogOpen = ref<boolean>(false);

const update = () => {
    form.put(route('products.update', form.id), {
        onSuccess: () => form.reset()
    })
}

const handleDelete = () => {
    router.delete(route('products.destroy', product.id), {
        preserveScroll: true,
        onFinish: () => isDialogOpen.value = false
    })
}
</script>

<template>

    <Head title="Update Product" />

    <ConfirmationDialog :is-open="isDialogOpen" title="Are you sure?" message="This action can't be undone"
        @confirm="handleDelete" @cancel="isDialogOpen = false" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    Update Product
                </h2>

                <div class="flex items-center gap-2">
                    <Link :href="route('products.index')"
                        class="font-medium rounded-md text-sm px-5 py-2.5 text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200">
                    Manage products</Link>

                    <button @click="isDialogOpen = true"
                        class="font-medium rounded-md text-sm px-5 py-2.5 text-white bg-red-700 border border-red-500 focus:outline-none hover:bg-red-600 focus:ring-4 focus:ring-red-500">
                        Delete
                    </button>
                </div>
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="flex items-center justify-center">
                    <div class="relative w-full max-w-2xl max-h-full">
                        <ProductForm :categories="categories" :form="form" @submit="update">
                            <button type="submit"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Update</button>
                            <Link :href="route('products.index')"
                                class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5">
                            Cancel</Link>
                        </ProductForm>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

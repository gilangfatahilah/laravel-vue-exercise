<script setup lang="ts">
import { Head, Link, useForm } from "@inertiajs/vue3";
import { Product } from "@/types";

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { default as ProductForm } from "@/Components/Forms/Product.vue";

const { categories } = defineProps<{
    categories: Product["category"][];
}>();

const form = useForm({
    name: "",
    brand: "",
    category_id: null,
    price: null,
    weight: null,
    description: "",
});

const store = () => {
    form.post(route("products.store"), {
        onSuccess: () => form.reset(),
    });
};
</script>

<template>
    <Head title="New Product" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    New Product
                </h2>

                <Link
                    :href="route('products.index')"
                    class="font-medium rounded-md text-sm px-5 py-2.5 text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200"
                >
                    Manage products</Link
                >
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="flex items-center justify-center">
                    <div class="relative w-full max-w-2xl max-h-full">
                        <ProductForm
                            :categories="categories"
                            :form="form"
                            @submit="store"
                        >
                            <button
                                type="submit"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                            >
                                Save
                            </button>
                            <Link
                                :href="route('products.index')"
                                class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5"
                            >
                                Cancel</Link
                            >
                        </ProductForm>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

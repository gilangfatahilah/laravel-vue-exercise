<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { Product } from '@/types';

const { categories, product } = defineProps<{
    categories: Product['category'][]
    product: Product
}>();

const form = useForm({
    ...product,
    category_id: product.category.id
})

const update = () => {
    form.put(route('products.update', form.id), {
        onSuccess: () => form.reset()
    })
}
</script>

<template>

    <Head title="Update Product" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    Update Product
                </h2>

                <Link :href="route('products.index')"
                    class="font-medium rounded-md text-sm px-5 py-2.5 text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200">
                Manage products</Link>
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="flex items-center justify-center">
                    <div class="relative w-full max-w-2xl max-h-full">
                        <form class="relative bg-white rounded-lg shadow" @submit.prevent="update">
                            <div class="p-6 space-y-6">
                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6 sm:col-span-6">
                                        <label for="name" class="block mb-2 text-sm font-medium" :class="{
                                            'text-gray-900': !form.errors.name,
                                            'text-red-700': form.errors.name
                                        }">
                                            Product name
                                        </label>
                                        <input type="text" name="name" v-model="form.name" id="name"
                                            class="shadow-sm border text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                            :class="{
                                                'bg-red-50 border-red-500 text-red-900': form.errors.name,
                                                'bg-gray-50 border-gray-300 text-gray-900': !form.errors.name
                                            }">
                                        <p class="font-sm text-red-500 mt-2" v-if="form.errors.name">{{
                                            form.errors.name }}
                                        </p>
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="brand" class="block mb-2 text-sm font-medium" :class="{
                                            'text-gray-900': !form.errors.brand,
                                            'text-red-700': form.errors.brand
                                        }">
                                            Brand
                                        </label>
                                        <input type="text" name="brand" v-model="form.brand" id="brand"
                                            class="shadow-sm border text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                            :class="{
                                                'bg-red-50 border-red-500 text-red-900': form.errors.brand,
                                                'bg-gray-50 border-gray-300 text-gray-900': !form.errors.brand
                                            }">
                                        <p class="font-sm text-red-500 mt-2" v-if="form.errors.brand">{{
                                            form.errors.brand }}
                                        </p>
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="category_id" class="block mb-2 text-sm font-medium " :class="{
                                            'text-gray-900': !form.errors.category_id,
                                            'text-red-700': form.errors.category_id
                                        }">Category</label>
                                        <select name="category_id" v-model="form.category_id" id="category_id"
                                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                            :class="{
                                                'bg-gray-50 border-gray-300 text-gray-900': !form.errors.category_id,
                                                'bg-red-50 border-red-500 text-red-900': form.errors.category_id
                                            }">
                                            <option value="">Select a category</option>
                                            <option v-for="category in categories" :key="category.id"
                                                :value="category.id">{{
                                                    category.name }}</option>
                                        </select>

                                        <p class="font-sm text-red-500 mt-2" v-if="form.errors.category_id">{{
                                            form.errors.category_id }}
                                        </p>
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="price" class="block mb-2 text-sm font-medium " :class="{
                                            'text-gray-900': !form.errors.price,
                                            'text-red-700': form.errors.price
                                        }">Price</label>
                                        <input type="number" name="price" v-model="form.price" id="price"
                                            class="shadow-sm border text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                            :class="{
                                                'bg-gray-50 border-gray-300 text-gray-900': !form.errors.price,
                                                'bg-red-50 border-red-500 text-red-900': form.errors.price
                                            }">

                                        <p class="font-sm text-red-500 mt-2" v-if="form.errors.price">{{
                                            form.errors.price }}
                                        </p>
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="stocks" class="block mb-2 text-sm font-medium " :class="{
                                            'text-gray-900': !form.errors.weight,
                                            'text-red-700': form.errors.weight
                                        }">Weight</label>
                                        <input type="number" name="stocks" v-model="form.weight" id="stocks"
                                            class="shadow-sm border text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                            :class="{
                                                'bg-gray-50 border-gray-300 text-gray-900': !form.errors.weight,
                                                'bg-red-50 border-red-500 text-red-900': form.errors.weight,
                                            }">

                                        <p class="font-sm text-red-500 mt-2" v-if="form.errors.weight">{{
                                            form.errors.weight }}
                                        </p>
                                    </div>
                                    <div class="col-span-6 sm:col-span-6">
                                        <label for="description" class="block mb-2 text-sm font-medium " :class="{
                                            'text-gray-900': !form.errors.description,
                                            'text-red-700': form.errors.description,
                                        }">Description</label>
                                        <textarea name="description" v-model="form.description" id="description"
                                            class="shadow-sm border text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                            :class="{
                                                'bg-gray-50 border-gray-300 text-gray-900': !form.errors.description,
                                                'bg-red-50 border-red-500 text-red-900': form.errors.description,
                                            }" rows="3"></textarea>

                                        <p class="font-sm text-red-500 mt-2" v-if="form.errors.description">{{
                                            form.errors.description }}
                                        </p>
                                    </div>
                                    <div class="col-span-6 sm:col-span-6 space-x-2">
                                        <button type="submit"
                                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">update</button>
                                        <button type="button"
                                            class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

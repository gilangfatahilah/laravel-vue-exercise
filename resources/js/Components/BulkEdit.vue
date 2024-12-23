<script setup lang="ts">
import { defineProps, defineEmits, ref } from "vue";
import Modal from "@/Components/Modal.vue";

type Category = {
    id: number;
    name: string;
};

interface Props {
    show: boolean;
    lists: Category[];
}

const props = defineProps<Props>();
const emit = defineEmits<{
    close: [];
    submit: [categoryId: number];
}>();

const selectedValue = ref<number>();
</script>

<template>
    <Modal :show="show" max-width="xl" @close="emit('close')">
        <form class="relative bg-white rounded-lg shadow">
            <!-- Modal header -->
            <div
                class="flex items-start justify-between p-4 border-b rounded-t"
            >
                <h3 class="text-xl font-semibold text-gray-900">Bulk Edit</h3>
                <button
                    @click.prevent="emit('close')"
                    type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="editUserModal"
                >
                    <svg
                        class="w-3.5 h-3.5"
                        aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 14 14"
                    >
                        <path
                            stroke="currentColor"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"
                        />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-6 space-y-6">
                <div>
                    <label
                        for="category_id"
                        class="block mb-2 text-sm font-medium text-gray-900"
                    >
                        Category
                    </label>
                    <select
                        name="category_id"
                        id="category_id"
                        v-model="selectedValue"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                        required
                    >
                        <option
                            :key="list.id"
                            v-for="list in lists"
                            :value="list.id"
                        >
                            {{ list.name }}
                        </option>
                    </select>
                </div>
            </div>
            <!-- Modal footer -->
            <div class="text-right p-6 space-x-2 border-t rounded-b">
                <button
                    @click.prevent="emit('close')"
                    type="button"
                    class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5"
                >
                    Cancel
                </button>
                <button
                    type="submit"
                    :disabled="!selectedValue"
                    @click.prevent="emit('submit', selectedValue ?? 0)"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                >
                    Update
                </button>
            </div>
        </form>
    </Modal>
</template>

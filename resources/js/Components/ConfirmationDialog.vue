<script setup lang="ts">
defineProps<{
    isOpen: boolean;
    title: string;
    message: string;
}>();

const emit = defineEmits<{
    confirm: [];
    cancel: [];
}>();

</script>

<template>
    <!-- Backdrop -->
    <div v-if="isOpen" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-50">
        <!-- Dialog Box -->
        <div class="bg-white rounded-lg shadow-lg w-96">
            <!-- Dialog Header -->
            <div class="p-4 border-b">
                <h3 class="text-lg font-semibold text-gray-800">{{ title }}</h3>
            </div>

            <!-- Dialog Content -->
            <div class="p-4">
                <p class="text-gray-600">{{ message }}</p>
            </div>

            <!-- Dialog Actions -->
            <div class="flex justify-end space-x-2 p-4 border-t">
                <button @click="emit('cancel')"
                    class="px-4 py-2 text-gray-600 bg-gray-200 rounded hover:bg-gray-300 transition">
                    Cancel
                </button>
                <button @click="emit('confirm')"
                    class="px-4 py-2 text-white bg-red-500 rounded hover:bg-red-600 transition">
                    Confirm
                </button>
            </div>
        </div>
    </div>
</template>
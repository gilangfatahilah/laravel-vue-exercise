<script setup lang="ts">
import { ref, watch } from 'vue';

interface Props {
    open: boolean;
    message: string;
    type?: 'success' | 'error' | 'info' | 'warning';
    duration?: number;
}

const props = defineProps<Props>();

const isVisible = ref<boolean>(props.open);

const typeClasses = {
    'success': 'border-green-500',
    'error': 'border-red-500',
    'info': 'border-blue-500',
    'warning': 'border-yellow-500',
}[props.type || 'info'];

const closeToast = () => {
    isVisible.value = false;
};

watch(
    () => props.duration,
    (duration) => {
        if (duration) {
            setTimeout(closeToast, duration);
        }
    },
    { immediate: true }
);
</script>

<template>
    <!-- Container Toast -->
    <Transition enter-active-class="transform transition ease-out duration-300"
        enter-from-class="translate-y-10 opacity-0" enter-to-class="translate-y-0 opacity-100"
        leave-active-class="transform transition ease-in duration-300" leave-from-class="translate-y-0 opacity-100"
        leave-to-class="translate-y-10 opacity-0">
        <div v-if="isVisible"
            class="fixed bottom-5 right-5 bg-white text-gray-800 shadow-lg rounded-lg px-4 py-3 flex items-center space-x-4 border-l-4"
            :class="typeClasses">
            <!-- Icon -->
            <div>
                <slot name="icon">
                    <span v-if="type === 'success'" class="text-green-500">✔</span>
                    <span v-else-if="type === 'error'" class="text-red-500">✖</span>
                    <span v-else-if="type === 'info'" class="text-blue-500">ℹ</span>
                    <span v-else class="text-gray-500">⚠</span>
                </slot>
            </div>

            <!-- Message -->
            <div class="flex-1">
                <p class="font-medium">{{ message }}</p>
            </div>

            <!-- Close Button -->
            <button @click="closeToast" class="text-gray-500 hover:text-gray-700 transition">
                ✕
            </button>
        </div>
    </Transition>
</template>
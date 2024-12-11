<script setup lang="ts">
import { computed } from "vue";
import { router } from "@inertiajs/vue3";

const { name, label } = defineProps < {
    name: string,
    label: string
} > ()

const sortClass = computed(() => {
    const urlParams = new URLSearchParams(window.location.search)
    let sortBy = urlParams.get('sort_by') || ""
    let sortDir = sortBy.charAt(0)
    return sortBy.replace(/^\-+/, "") === name ?
        (sortDir === '-' ? 'desc' : 'asc') :
        ""
})

const navigate = () => {
    const urlParams = new URLSearchParams(window.location.search)
    let sortBy = urlParams.get('sort_by') || ""
    let sortDir = sortBy.charAt(0)
    sortBy = !sortBy || sortDir === '-' ? name : `-${name}`
    urlParams.set('sort_by', sortBy)
    const params = Object.fromEntries(urlParams.entries())
    router.get(route(route().current() as string), params)
}
</script>

<template>
    <a href="#" @click.prevent="navigate" class="sortable" :class="sortClass">{{ label }}</a>
</template>
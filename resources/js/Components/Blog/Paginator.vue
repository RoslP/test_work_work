<script setup>

import {Link} from "@inertiajs/vue3";
import {defineProps} from "vue";

const props = defineProps({
  articles: {
    type: Array,
    required: true
  }
});
</script>

<template>
    <!-- Пагинатор -->
    <div class="pagination flex gap-2 justify-center mt-6">
        <Link
            class="page-link"
            :class="{ disabled: articles.current_page === 1 }"
            :href="route('post.list', { page: articles.current_page - 1 })"
            v-if="articles.current_page > 1"
        >
            «
        </Link>

        <Link
            v-for="i in articles.last_page"
            :key="i"
            class="page-link"
            :href="route('post.list', { page: i })"
            :class="{ active: i === articles.current_page }"
        >
            {{ i }}
        </Link>

        <Link
            class="page-link"
            :class="{ disabled: articles.current_page === articles.last_page }"
            :href="route('post.list', { page: articles.current_page + 1 })"
            v-if="articles.current_page < articles.last_page"
        >
            »
        </Link>
    </div>
</template>

<style scoped>

</style>

<script setup>
import {defineProps} from 'vue'

const props = defineProps({
    articles: {
        type: Array,
        required: true
    }
});

</script>

<template>
    <div
        v-for="(article,key) in articles.data"
        :key="key"
    >
        <div class="articles-content">
            <div class="articles-storage">
                <div class="article-title">
                    <div>
                        {{ article.title }}
                    </div>
                </div>
                <div class="article-category-name">
                    <div>
                        <span>{{ article.name }}</span>
                    </div>
                    <div>
                        Автор: <span>{{ article.author }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>

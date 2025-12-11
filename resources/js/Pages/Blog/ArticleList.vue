<script setup>
import {defineProps} from 'vue'
import {Link} from '@inertiajs/vue3';
import Paginator from "@/Components/Blog/Paginator.vue";

const props = defineProps({
    articles: {
        type: Array,
        required: true
    }
});

</script>

<template>


    <div class="article-paginator">
        <paginator :articles="articles"/>
    </div>
    <div
        v-for="(article,key) in articles.data"
        :key="key"
    >
        <div class="articles-content">
            <div class="articles-storage">
                <div class="article-title">
                    <div>
                        <Link :href="route('post.show',{title: article.title})">
                            {{ article.title }}
                        </Link>
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
    <div class="article-paginator">
        <paginator :articles="articles"/>
    </div>
</template>

<style scoped>

</style>

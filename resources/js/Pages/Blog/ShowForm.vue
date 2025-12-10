<script setup>
import {defineProps} from "vue";
import Comments from "@/Components/Blog/Comments.vue";

const props = defineProps({
    article: {
        type: Array,
        required: true
    },
    currentUserId: Number
});

</script>

<template>
    <div>
        <div class="show-form__wrapper">
            <div class="show-form__height">
                <div class="show-form">
                    <div class="article-title">
                        {{ props.article.title }}
                    </div>
                    <div class="show-form-name">
                        {{ props.article.name }}
                    </div>
                    <div class="show-form-content">
                        {{ props.article.content }}
                    </div>
                    <div>
                        Автор: <span class="show-form-author">{{ props.article.author }}</span>
                    </div>
                </div>
                <Comments :current-user-id="props.currentUserId" :article-id="props.article.id"/>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>

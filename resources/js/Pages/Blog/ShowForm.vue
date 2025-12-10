<script setup>
import {defineProps, ref} from "vue";
import axios from "axios";

axios.defaults.withCredentials = true

const props = defineProps({
    article: {
        type: Array,
        required: true
    },
    currentUserId: Number
});

const commentData = ref('')
const savePostComment = async () => {
    await axios.post('/api/comment',{user_id:props.currentUserId, content: commentData.value, article_id:props.article.id})
}
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
                <section class="show-form__height" aria-labelledby="comments-title">
                    <h1 id="comments-title" style="font-size:18px;margin:0 0 10px 0;">Оставить комментарий</h1>

                    <form class="comment-form" action="#" method="post" novalidate>
                        <div class="show-form-content">
                            <label for="comment" class="visually-hidden" style="position:absolute;left:-9999px">Текст комментария</label>
                            <textarea id="comment" class="comment-textarea" name="comment" placeholder="Напишите ваш комментарий..." maxlength="2000" required
                            v-model="commentData"
                            ></textarea>
                        </div>

                        <div class="comment-row">
                            <div class="comment-actions">
                                <button type="reset" class="btn btn-secondary">Очистить</button>
                                <button type="button" class="btn btn-primary" @click="savePostComment">Отправить</button>
                            </div>
                        </div>

                    </form>

                    <div class="comments-list" aria-live="polite">
                        <div class="comment-item"><span style="font-weight: bold">Pavel:</span> Пример комментария: здесь показан</div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>

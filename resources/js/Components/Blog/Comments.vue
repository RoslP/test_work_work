<script setup>
import {ref} from "vue";
import axios from "axios";
axios.defaults.withCredentials = true

const props = defineProps({
    currentUserId: Number,
    articleId: Number
});

const commentData = ref('')
const savePostComment = async () => {
    await axios.post('/api/comment',{user_id:props.currentUserId, content: commentData.value, article_id:props.currentUserId})
}
</script>

<template>
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

</template>

<style scoped>

</style>

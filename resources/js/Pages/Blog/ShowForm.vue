<script setup>
import {defineProps, reactive, ref} from "vue";
import Comments from "@/Components/Blog/Comments.vue";
import axios from "axios";
import UploadPhotos from "@/Components/Blog/UploadPhotos.vue";

const props = defineProps({
    article: {
        type: Array,
        required: true
    },
    currentUserId: Number
});

const articleCategories = reactive({
    category: [],
})

const articleCopy = reactive({ ...props.article });

const getCategoryList = async () => {
    await axios.get('/api/category')
        .then(res => {
            articleCategories.category = res.data
            articleCategories.category.forEach((item, index) =>{
                if (item.name===props.article.name){
                    articleCategories.category[index].selectedStatus = true
                    articleCopy.category_id = articleCategories.category[index].id
                }
            })
        });
}

const selectCategory = (id) => {
    let categories = articleCategories.category;
    categories.forEach((item, index) => {
        if (item.id === id) {
            categories[index].selectedStatus = true;
            articleCopy.category_id = categories[index].id
        } else {
            categories[index].selectedStatus = false;
        }
    });
}

const isModalOpen = ref(false)

const openModal = async () => {
    isModalOpen.value = true
    await getCategoryList()
}

const closeModal = () => {

    isModalOpen.value = false
}

const deleteArticle = async () => {
    await axios.delete('/api/articles/' + props.article.id)
        .then(() => {
            alert('Статья удалена')
            window.location.href = '/post-list';
        })
}

const editArticle = async () => {
    console.log(articleCopy)
    await axios.put('/api/articles/' + articleCopy.id, { ...articleCopy })

        .then(res => {
            console.log(res)

            window.location.href = `http://localhost:8876/post/${encodeURIComponent(res.data)}`;
            }
        )
}
</script>

<template>
    <div>
        <div class="show-form__wrapper">
            <div class="show-form__height">
                <div class="edit-form__grid">
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
                    <div>
                        <button class="edit-btn" @click="openModal">Редактировать</button>
                    </div>
                </div>
                <Comments :current-user-id="props.currentUserId" :article-id="props.article.id"/>
            </div>
        </div>

        <div v-if="isModalOpen" class="modal-overlay" @click.self="closeModal">
            <div class="modal-content">
                <button class="close-btn" @click="closeModal">&times;</button>
                <h2>Редактировать статью</h2>
                <form>
                    <input type="text" v-model="articleCopy.title" placeholder="Название" />
                    <div class="category-name__container">
                    <span v-for="(category, key) in articleCategories.category"
                          :key="key"
                          class="category-name__item"
                          :class="{'item-category__selected': category.selectedStatus === true}"
                          @click="selectCategory(category.id)"
                    >
                        {{category.name}}
                    </span>
                    </div>
                    <textarea placeholder="Контент" v-model="articleCopy.content"></textarea>
                    <upload-photos/>
                    <div>
                        <button type="button" style="margin-top: 15px" class="save-btn"
                        @click="editArticle"
                        >Сохранить</button>
                    </div>
                    <div>
                        <button type="button" style="margin-top: 15px" class="delete-btn"
                        @click="deleteArticle"
                        >Удалить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<style scoped>
.save-btn {
    background-color: #279c1d;
    color: white;
}

.save-btn:hover {
    background-color: #195a14;
}
.delete-btn {
    background-color: #dc2626;
    color: white;
}

.delete-btn:hover {
    background-color: #b91c1c;
}
.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.6);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 1000;
}

.modal-content {
    background-color: white;
    width: 90%;
    max-width: 700px;
    height: 90%;
    padding: 20px;
    border-radius: 10px;
    overflow-y: auto;
    position: relative;
    display: flex;
    flex-direction: column;
}

.close-btn {
    position: absolute;
    top: 15px;
    right: 20px;
    font-size: 28px;
    background: none;
    border: none;
    cursor: pointer;
}

form {
    display: flex;
    flex-direction: column;
    gap: 15px;
    flex-grow: 1;
}

input, textarea {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    width: 100%;
    resize: none;
}

.modal-content button {
    padding: 10px 20px;
    border-radius: 5px;
    border: none;
    cursor: pointer;
    font-weight: 500;
    margin-top: 30px;
    transition: background-color 0.3s;}

</style>

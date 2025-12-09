<script setup>
import {reactive, ref, onMounted} from 'vue'
import ModalBlogEdit from "@/Components/Blog/ModalBlogEdit.vue";
import axios from "axios";

const isOpen = ref(false);

const openModal = () => {
    isOpen.value = true;
};

const closeModal = () => {
    isOpen.value = false;
};

const getCategoryList = async () => {
    await axios.get('/api/category')
        .then(res => {
            blogEditForm.category = res.data
        });
}

const blogEditForm = reactive({
    title: '',
    content: '',
    category: [],
})

const selectOrDeselectCategory = ( id ) => {
    blogEditForm.category.forEach((item, index)=>{
        if (id === item.id){
            blogEditForm.category[index].selectedStatus = !blogEditForm.category[index].selectedStatus
        }
    })
}



onMounted(()=>{
    getCategoryList()
})
</script>

<template>
    <div>
        Страница редактирования
        <section class="article--edit">
            <div>
                Категория
                <span @click="openModal" class="add-blog__element">
                +
            </span>
                <div class="category-name__container">
                    <span v-for="(category, key) in blogEditForm.category"
                    :key="key"
                    class="category-name__item"
                    :class="{'item-category__selected': category.selectedStatus === true}"
                    @click="selectOrDeselectCategory(category.id)"
                    >
                        {{category.name}}
                    </span>
                </div>
            </div>
            <div>
                <input placeholder="Заголовок статьи">
            </div>
            <div>
                <textarea class="blog--content" placeholder="Содержимое статьи"></textarea>
            </div>
            <ModalBlogEdit :is-open="isOpen" @close="closeModal" @refreshCategoryList="getCategoryList"/>
        </section>
    </div>
</template>

<style scoped>

</style>

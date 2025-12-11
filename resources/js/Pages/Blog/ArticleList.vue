<script setup>
import {defineProps, onMounted, ref} from 'vue'
import {Link} from '@inertiajs/vue3';
import Paginator from "@/Components/Blog/Paginator.vue";
import axios from "axios";

axios.defaults.withCredentials = true

const props = defineProps({
    articles: {
        type: Array,
        required: true
    }
});

const category = ref([])
const nameToSearch = ref('')

const getCategoryList = async () => {
    await axios.get('/api/category')
        .then(res => {
            category.value = res.data
        });
}


const currentSelectedCategory = ref([])
const selectOrDeselectCategory = (id) => {
    let cat = category.value[id]

    cat.selectedStatus = !cat.selectedStatus

    if (currentSelectedCategory.value.includes(cat.name)) {
        currentSelectedCategory.value = currentSelectedCategory.value.filter(
            name => name !== cat.name
        )
    } else {
        currentSelectedCategory.value.push(cat.name)
    }

    if (currentSelectedCategory.value.length === 0){
         getAllArticles()
    }
    else{
        searchByCategory(currentSelectedCategory.value)
    }
}

const searchByCategory = async (arrayOfNames) => {
    await axios.post('/api/articles/category', {categories: arrayOfNames}, { headers: { 'Content-Type': 'application/json' } })
        .then(res => {
            console.log(res)
            props.articles.data = res.data
        })
};

const searchByName = async () => {
    if (nameToSearch.value.trim() === '' || !nameToSearch.value) {
        await getAllArticles()
    } else {
        await axios.get('/api/article/' + nameToSearch.value)
            .then(res => {
                props.articles.data = res.data
            })
    }
}

const getAllArticles = async ()=>{
    await axios.get('/api/articles-all')
        .then(res =>{
            props.articles.data = res.data.data
        })
}
onMounted(() => {
    getCategoryList()
})
</script>

<template>
    <div class="articles-page">
        <div>
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
        </div>
        <div>
            <div class="filter-container">
                <div class="filter-form">
                    <!-- Поиск по названию -->
                    <div class="search-box">
                        <input type="text" placeholder="Поиск по названию..."
                        v-model="nameToSearch"
                        />
                        <button type="submit"
                        @click="searchByName"
                        >🔍</button>
                    </div>

                    <!-- Кнопки категорий -->
                    <div class="categories">
                        <button type="button" class="category-btn"
                        :class="{'active':category.selectedStatus === true}"
                        v-for="(category,id) in category"
                        :key="id"
                        @click="selectOrDeselectCategory(id)"
                        >
                        {{category.name}}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>

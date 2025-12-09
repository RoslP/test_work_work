<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, Link} from '@inertiajs/vue3';
import ArticleList from "@/Pages/Blog/ArticleList.vue";
import {ref} from "vue";
import ArticleForm from "@/Pages/Blog/ArticleForm.vue";

const props = defineProps({
    currentPage: String
})
const currentPage = ref('articles');
</script>

<template>
    <Head title="Dashboard"/>

    <AuthenticatedLayout>
        <section class="article">
            <div class="container-wrapper">
                <div class="content-container">
                    <div class="authenticated-nav">
                        <div class="authenticated-nav__item">

                            <Link
                                :href="route('post.create')"
                                class="ms-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                            >Добавить статью
                            </Link
                            >
                        </div>
                        <div
                            class="authenticated-nav__item ms-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                            <Link
                                :href="route('post.list')"
                                class="ms-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                            >Статьи
                            </Link
                            >
                        </div>
                        <div
                            class="authenticated-nav__item sidebar--menu ms-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                            Категории
                        </div>
                    </div>
                </div>
            </div>
            <div v-if="props.currentPage === 'articles'">
                <ArticleList/>
            </div>
            <div v-else-if="props.currentPage === 'create'">
                <ArticleForm/>
            </div>
        </section>
    </AuthenticatedLayout>
</template>

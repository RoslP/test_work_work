<script setup>
import {ref, defineProps,nextTick} from "vue";
import axios from "axios";

axios.defaults.withCredentials = true

const props = defineProps({
    isOpen: Boolean, // получаем состояние из родителя
});

const emit = defineEmits(["close","refreshCategoryList"]);

const closeModal = () => {
    emit("close"); //связь с родительским компонентом по тегу @close в родителе
};

const categoryName = ref('')

const saveCategory = (async () => {
    if (String(categoryName.value).trim() === '')
        return alert('Введите название категории')
    if (String(categoryName.value).length <= 3)
        return alert('Название должно быть более 3х символов')
    if (/\d/.test(categoryName.value) || /[..\-\!\*\<\>\,\/\&\^+?^${}()|[\]\\]/.test(categoryName.value))
        return alert('Строка содержит спецсимволы или цифры!')

    try {
        await axios.post('/api/category', {
            categoryName: categoryName.value
        })
        emit("refreshCategoryList")

    } catch (e) {
        console.log(e)
        alert('Не получилось')
    }
})
</script>

<template>
    <div class="modal">
        <div
            v-if="isOpen"
            class="fixed inset-0 bg-black/50 flex items-center justify-center"
            @click="closeModal"
        >
            <div
                class="bg-white p-6 rounded shadow-lg w-80"
                @click.stop
            >
                <h2 class="text-xl mb-4">Добавить категорию</h2>
                <input placeholder="введите название" v-model="categoryName">
                <div>
                    <button
                        class="mt-2 px-3 py-1 bg-green-500 text-white rounded"
                        @click="saveCategory"
                    >
                        Добавить
                    </button>
                </div>
                <div>
                    <button
                        class="mt-2 px-3 py-1 bg-red-500 text-white rounded"
                        @click="closeModal"
                    >
                        Закрыть
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>

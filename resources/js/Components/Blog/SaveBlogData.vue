<script setup>
import {defineProps, reactive} from "vue";
import axios from "axios";

axios.defaults.withCredentials = true

const props = defineProps({
    dataToSave: Object
});

const saveBlogData = async () => {
    let d = props.dataToSave
    console.log(d)
    if (String(d.content).length <= 30)
        return alert('Контент должен быть минимум из 30 символов')
    if (String(d.title).length <= 10)
        return alert('Заголовок должен быть не меньше 10 символов')

    let counter = 0
    let dataToSave = {}
    d.category.forEach((item, index) => {
        if (item.selectedStatus === true) {
            counter++
            dataToSave = {
                title: d.title,
                content: d.content,
                category_id: item.id
            }
        }
    })
    if (counter === 0)
        return alert('Выберите категорию поста')
    if (counter > 1)
        return alert('Выберите 1 категорию')

    try{
        await axios.post('/api/article', dataToSave)
        alert('Успешно')
    }
    catch (e){
        alert('Не удалось сохранить данные' + e)
    }
}
</script>

<template>
    <button
        @click="saveBlogData">
        Сохранить
    </button>
</template>

<style scoped>

</style>

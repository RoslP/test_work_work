<script setup>

import {ref} from 'vue';
import axios from 'axios';

const files = ref([]);

function handleFiles(event) {
    files.value = Array.from(event.target.files);
}

async function uploadFiles() {
    const formData = new FormData();
    files.value.forEach(file => formData.append('photos[]', file));

    try {
        await axios.post('/api/photos', formData, {
            headers: {'Content-Type': 'multipart/form-data', 'XDEBUG_SESSION': 'PHPSTORM'},
        });
        alert('Файлы загружены');
    } catch (err) {
        console.error(err);
    }
}
</script>

<template>
    <div class="file-input">
        Перенесите файл
        <div>
            <input type="file" multiple @change="handleFiles"/>
            <button type="button" @click.prevent="uploadFiles">Загрузить</button>
        </div>
    </div>
</template>

<style scoped>

</style>

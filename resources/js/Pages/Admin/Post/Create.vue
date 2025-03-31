<script>
import AdminLayouts from "@/Layouts/AdminLayouts.vue";
import { Link } from "@inertiajs/vue3";
import axios from "axios";

export default {
    name: "Create",
    layout: AdminLayouts,
    components: {
        Link
    },
    props: {
        categories: Array
    },
    data() {
        return {
            post: {
                category_id: null
            },
            errors: {},
            flashMessage: null
        }
    },
    updated() {
        if (this.flashMessage) {
            setTimeout(() => {
                this.flashMessage = null;
            }, 3000)
        }
    },
    methods: {
        storePost() {
            // Преобразуем дату в нужный формат
            if (this.post.published_at) {
                this.post.published_at = this.post.published_at.replace("T", " ");
            }

            axios.post(route('admin.posts.store'), this.post, {
                'headers': {
                    'Content-Type': 'multipart/form-data'
                }
            })
                .then(res => {
                    if (res.status === 200) {
                        this.flashMessage = res.data;
                    }
                })
                .catch(error => {
                    if (error.response && error.response.data.errors) {
                        this.errors = error.response.data.errors;
                    }
                })
        },
        addImg(event) {
            this.post.images = event.target.files;
        }
    }
}

</script>

<template>
    <div class="max-w-2xl p-6 bg-white rounded-lg shadow-md">
        <div v-if="flashMessage" class="bg-green-500 text-white p-3 rounded mb-4">
            {{ flashMessage }}
        </div>
        <h1 class="text-2xl font-bold mb-6">Создание нового поста</h1>
            <!-- Title -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Заголовок</label>
                <input v-model="post.title"
                    type="text"
                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                       :class="{ 'border-red-500': errors.title }"
                />
                <p v-if="errors.title" class="text-red-500 text-xs mt-1">{{ errors.title[0] }}</p>
            </div>

            <!-- Text -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Текст</label>
                <textarea v-model="post.text"
                    rows="4"
                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                          :class="{ 'border-red-500': errors.text }"
                ></textarea>
                <p v-if="errors.text" class="text-red-500 text-xs mt-1">{{ errors.text[0] }}</p>
            </div>

            <!-- Date -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Дата публикации</label>
                <input v-model="post.published_at"
                    type="datetime-local"
                       step="300"
                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                       :class="{ 'border-red-500': this.errors.message }"
                />
                <p v-if="errors.published_at" class="text-red-500 text-xs mt-1">{{ errors.published_at[0] }}</p>
            </div>

            <!-- File -->
            <div class="mb-4">
                <input @change="addImg" type="file" multiple
                       class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                       :class="{ 'border-red-500': this.errors.message }"
                />
                <p v-if="errors.images" class="text-red-500 text-xs mt-1">{{ errors.images[0] }}</p>
            </div>

            <!-- Category ID -->
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Категория</label>
                <select v-model="post.category_id"
                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        :class="{ 'border-red-500': errors.category_id }"
                >
                    <option selected value="null" disabled>Выберите категорию</option>
                    <option v-for="category in categories" :key="category.id" :value="category.id">
                        {{ category.title }}
                    </option>
                </select>
                <p v-if="errors.category_id" class="text-red-500 text-xs mt-1">{{ errors.category_id[0] }}</p>
            </div>

            <!-- Buttons -->
            <div class="flex items-center justify-between">
                <a @click.prevent="storePost" href="#" class="bg-emerald-500 hover:bg-emerald-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Сохранить
                </a>
                <Link
                    :href="route('admin.posts.index')"
                    class="ml-4 bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Вернуться
                </Link>
            </div>
    </div>
</template>

<style scoped>
/* Можно добавить кастомные стили при необходимости */
</style>

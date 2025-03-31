<script>
import { Link } from "@inertiajs/vue3";
import AdminLayouts from "@/Layouts/AdminLayouts.vue";
import axios from "axios";
import { router } from "@inertiajs/vue3"

export default {
    name: "Index",
    props: {
        'posts': Array,
        'postsCount': String
    },
    layout: AdminLayouts,
    components: {
        Link
    },
    data() {
        return {
            flashMessage: null
        }
    },
    updated() {
        if (this.flashMessage) {
            setTimeout(() => {
                this.flashMessage = null;
                router.visit(route('admin.posts.index'), {
                    method: 'get',
                    preserveState: false, // Перезагружает страницу
                    preserveScroll: true
                })
            }, 2000)
        }
    },
    methods: {
        deletePost(post) {
            axios.delete(route('admin.posts.destroy', post))
                .then(res => {
                    if (res.status === 200) {
                        this.flashMessage = res.data;
                    }
                })
                .catch(error => {

                })
        }
    }
}
</script>

<template>
    <!-- Основной контент -->
    <main class="flex-1 p-6">
        <!-- Шапка -->
        <div class="flex justify-between items-center mb-6">
            <div v-if="flashMessage" class="bg-green-500 text-white p-3 rounded mb-4">
                {{ flashMessage }}
            </div>
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Управление контентом</h1>
                <p class="text-gray-600">Всего постов: {{ postsCount }}</p>
            </div>
            <button class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                <Link :href="route('admin.posts.create')">+ Новый пост</Link>
            </button>
        </div>

        <!-- Фильтры -->
<!--        <div class="bg-white p-4 rounded-lg shadow-sm mb-6">
            <div class="flex flex-wrap gap-4">
                <select class="bg-gray-50 px-4 py-2 rounded-lg">
                    <option>Все категории</option>
                    <option>Технологии</option>
                    <option>Путешествия</option>
                </select>
                <select class="bg-gray-50 px-4 py-2 rounded-lg">
                    <option>Любой статус</option>
                    <option>Опубликовано</option>
                    <option>Черновик</option>
                </select>
                <input type="date" class="bg-gray-50 px-4 py-2 rounded-lg">
            </div>
        </div>-->

        <!-- Список постов -->
        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-sm text-gray-500">Заголовок</th>
                    <th class="px-4 py-3 text-left text-sm text-gray-500">Категория</th>
                    <th class="px-4 py-3 text-left text-sm text-gray-500">Дата</th>
                    <th class="px-4 py-3 text-left text-sm text-gray-500">Статус</th>
                    <th class="px-4 py-3 text-left text-sm text-gray-500">Действия</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200" v-for="post in posts">
                <!-- Пример поста -->
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-4"><Link :href="route('admin.posts.show', post.id)">{{ post.title }}</Link></td>
                    <td class="px-4 py-4">
                        <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-sm">{{ post.category.title }}</span>
                    </td>
                    <td class="px-4 py-4">{{ post.published_at }}</td>
                    <td class="px-4 py-4">
                        <span v-if="post.is_published" class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-sm">Опубликовано</span>
                        <span v-else class="bg-pink-950 text-white px-2 py-1 rounded-full text-sm">Заблокировано</span>
                    </td>
                    <td class="px-4 py-4">
                        <button class="text-blue-500 hover:text-blue-700 mr-2">✏️</button>
                        <a @click.prevent="deletePost(post.id)" href="#"><button class="text-red-500 hover:text-red-700">🗑️</button></a>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

        <!-- Добавление категории -->
        <div class="mt-6 bg-white p-6 rounded-lg shadow-sm">
            <h3 class="text-lg font-semibold mb-4">Новая категория</h3>
            <div class="flex gap-4">
                <input type="text" placeholder="Название категории" class="flex-1 bg-gray-50 px-4 py-2 rounded-lg">
                <button class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">
                    Добавить
                </button>
            </div>
        </div>
    </main>
</template>

<style scoped>

</style>

<script>
import {Link} from "@inertiajs/vue3";

export default {
    name: "AdminLayouts",
    components: {
        Link
    }
}
</script>

<template>
    <div class="min-h-screen flex">
        <!-- Боковая панель -->
        <aside class="bg-gray-800 w-64 min-h-screen p-4">
            <div class="mb-8">
                <h2 class="text-white text-xl font-bold">Админ-панель</h2>
            </div>
            <nav class="space-y-2">
                <Link :href="route('admin.posts.index')" class="flex items-center p-2 text-white bg-gray-700 rounded-lg">
                    📝 Посты
                </Link>
                <Link :href="route('admin.categories.index')" class="flex items-center p-2 text-gray-300 hover:bg-gray-700 rounded-lg">
                    📂 Категории
                </Link>
                <Link :href="route('admin.comments.index')" class="flex items-center p-2 text-gray-300 hover:bg-gray-700 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 01-.923 1.785c-.21.196-.315.295-.384.335a.622.622 0 01-.278.079C3.454 21.41 3 20.872 3 20.25v-.194c0-.15.045-.297.135-.426.177-.255.42-.498.706-.773l.044-.043c.286-.286.444-.444.575-.573.15-.145.238-.265.316-.398.173-.296.31-.674.375-1.154A9.04 9.04 0 013 12"/>
                    </svg>Комментарии
                </Link>
            </nav>
            <!-- Кнопка выхода -->
            <div class="mt-4">
                <Link
                    :href="route('logout')"
                    method="post"
                    as="button"
                    class="w-full flex items-center p-2 text-red-400 hover:bg-gray-700 rounded-lg transition-colors"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                    </svg>
                    Выход
                </Link>
            </div>
        </aside>
        <slot />
    </div>
</template>

<style scoped>

</style>

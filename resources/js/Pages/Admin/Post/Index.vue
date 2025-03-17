<script>
import { Link } from "@inertiajs/vue3";

export default {
    name: "Index",
    props: {
        'posts': Array
    },
    components: {
        Link
    }
}
</script>

<template>
    <div class="mt-10">
        <div><h2>Список</h2></div>
        <div v-for="post in posts" class="mb-4 pb-4 border-b border-gray-200">
            <Link :href="route('admin.posts.show', post.id)">{{ post.title }}</Link>
        </div>
    </div>
</template>

<style scoped>

</style>

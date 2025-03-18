<script>
import { Link } from "@inertiajs/vue3";

export default {
    name: "Index",
    props: {
        'comments': Array
    },
    components: {
        Link
    }
}
</script>

<template>
    <div class="mt-10">
        <div><h2>Список</h2></div>
        <div v-for="comment in comments" class="mt-10 mb-4 pb-4 border-b border-gray-200">
            <Link :href="route('admin.comments.show', comment.id)">
                <p>Комментарий к посту: {{ comment.post.title }}</p>
            </Link>
        </div>
    </div>
</template>

<style scoped>

</style>

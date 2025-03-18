<script>
import { Link } from "@inertiajs/vue3";

export default {
    name: "Index",
    props: {
        'categories': Array
    },
    components: {
        Link
    }
}
</script>

<template>
    <div class="mt-10">
        <div><h2>Список</h2></div>
        <div v-for="category in categories" class="mt-10 mb-4 pb-4 border-b border-gray-200">
            <Link :href="route('admin.categories.show', category.id)">{{ category.title }}</Link>
        </div>
    </div>
</template>

<style scoped>

</style>

<script>
import { Link } from "@inertiajs/vue3";
export default {
    name: "Show",
    props: {
        'category': Object
    },
     components: {
        Link
     }
}
</script>

<template>
    <div>
        <div class="mt-10 mb-6">
            <Link :href="route('admin.categories.index')" class="inline-block px-3 py-2 bg-indigo-700 text-white border border-indigo-800 rounded-full">
                Назад
            </Link>
        </div>
        <div class="mb-4 pb-4 border-b border-gray-200">
            <h3>{{ category.title }}</h3>
        </div>
    </div>
</template>

<style scoped>

</style>

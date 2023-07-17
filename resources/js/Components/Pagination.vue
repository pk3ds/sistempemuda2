<script>
import { Link } from "@inertiajs/inertia-vue3";

export default {
    components: {
        Link,
    },
    props: {
        links: Array,
        from: Number,
        to: Number,
        total: Number,
    },
};
</script>

<template>
    <div v-if="links.length > 3" class="flex justify-between">
        <div class="flex flex-wrap -mb-1">
            <template v-for="(link, key) in links">
                <div v-if="link.url === null" :key="key"
                    class="mb-1 mr-1 px-4 py-3 text-gray-400 text-sm leading-4 border rounded-md" v-html="link.label" />
                <Link v-else :key="`link-${key}`"
                    class="mb-1 mr-1 px-4 py-3 text-sm leading-4 hover:bg-indigo-300 border focus:border-indigo-500 rounded-md"
                    :class="{ 'bg-indigo-200': link.active }" :href="link.url" v-html="link.label" />
            </template>
        </div>
        <p class="pt-4 text-gray-400 text-sm">Showing {{ from }} to {{ to }} of {{ total }}</p>
    </div>
</template>

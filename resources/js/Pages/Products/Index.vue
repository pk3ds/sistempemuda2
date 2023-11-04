<script>
import { Head, Link } from "@inertiajs/inertia-vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import SearchFilter from '@/Components/SearchFilter.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import DangerButton from '@/Components/DangerButton.vue';
import Pagination from '@/Components/Pagination.vue';
import pickBy from "lodash/pickBy";
import throttle from "lodash/throttle";

export default {
    components: {
        Head,
        Link,
        AuthenticatedLayout,
        SearchFilter,
        PrimaryButton,
        SecondaryButton,
        DangerButton,
        Pagination,
    },
    props: {
        filters: Object,
        products: Object,
    },
    data() {
        return {
            form: {
                search: this.filters.search,
            },
        };
    },
    watch: {
        form: {
            deep: true,
            handler: throttle(function () {
                this.$inertia.get(route("products.index"), pickBy(this.form), {
                    preserveState: true,
                });
            }, 150),
        },
    },
    methods: {
        deleteItem(item) {
            if (confirm('Are you sure you want to delete "' + item.name + ' (' + item.uuid + ')"?'))
                this.$inertia.delete(route('products.destroy', item.id));
        },
    },
};
</script>

<template>

    <Head title="Products" />

    <AuthenticatedLayout :auth="$page.props.auth">
        <div class="pt-8 pb-2">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="lg:px-6 flex justify-between border-b pb-2">
                            <h4 class="text-lg mt-2 mr-2">Products</h4>
                            <SearchFilter v-model="form.search" class="mr-4 w-full max-w-md">
                            </SearchFilter>
                            <PrimaryButton>
                                <Link :href="route('products.create')">Add</Link>
                            </PrimaryButton>
                        </div>
                        <div class="flex flex-col">
                            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                                <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                                    <div class="overflow-hidden">
                                        <table class="min-w-full">
                                            <thead class="bg-white border-b">
                                                <tr>
                                                    <th scope="col"
                                                        class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                        Name
                                                    </th>
                                                    <th scope="col"
                                                        class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                        Price
                                                    </th>
                                                    <th scope="col"
                                                        class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                        Action
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="product in products.data"
                                                    class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
                                                    <td class="text-sm text-gray-900 font-light px-6 py-4">
                                                        <Link :href="route('products.edit', product)">{{ product.name }}</Link>
                                                    </td>
                                                    <td class="text-sm text-gray-900 font-light px-6 py-4">
                                                        {{ product.price }}
                                                    </td>
                                                    <td class="text-sm text-gray-900 font-light px-6 py-4">
                                                        <SecondaryButton class="mx-1">
                                                            <Link :href="route('products.edit', product)">View</Link>
                                                        </SecondaryButton>
                                                        <DangerButton class="mx-1" @click="deleteItem(product)">
                                                            Delete
                                                        </DangerButton>
                                                    </td>
                                                </tr>
                                                <tr v-if="products.data.length === 0">
                                                    <td class="px-6 py-4 border-t text-center" colspan="6">
                                                        No products found.
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <Pagination class="mt-6" :links="products.links" :from="products.from" :to="products.to"
                                        :total="products.total" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
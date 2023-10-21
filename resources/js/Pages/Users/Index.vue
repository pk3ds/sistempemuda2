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
        users: Object,
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
                this.$inertia.get(route("users"), pickBy(this.form), {
                    preserveState: true,
                });
            }, 150),
        },
    },
    methods: {
        deleteItem(item) {
            if (confirm('Are you sure you want to delete "' + item.name + ' (' + item.staff_id + ')"?'))
                this.$inertia.delete(route('users.destroy', item.id));
        },
        formatDate(date) {
            return new Intl
                .DateTimeFormat('en-my', {
                    dateStyle: 'medium',
                    timeStyle: 'short',
                    timeZone: 'Asia/Kuala_Lumpur',
                    hour12: false,
                })
                .format(new Date(date));
        },
        getActivation(boolean, date) {
            return boolean ? this.formatDate(date) : 'Not activated'
        },
    },
};
</script>

<template>

    <Head title="Users" />

    <AuthenticatedLayout :auth="$page.props.auth">
        <div class="pt-8 pb-2">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="lg:px-6 flex justify-between border-b pb-2">
                            <h4 class="text-lg mt-2 mr-2">Users</h4>
                            <SearchFilter v-model="form.search" class="mr-4 w-full max-w-md">
                            </SearchFilter>
                            <PrimaryButton>
                                <Link :href="route('users.create')">Add</Link>
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
                                                        Username
                                                    </th>
                                                    <th scope="col"
                                                        class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                        No Tel
                                                    </th>
                                                    <th scope="col"
                                                        class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                        Activation
                                                    </th>
                                                    <th scope="col"
                                                        class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                        Action
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="user in users.data"
                                                    class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
                                                    <td class="text-sm text-gray-900 font-light px-6 py-4">
                                                        <Link :href="route('users.edit', user)">{{ user.name }}</Link>
                                                    </td>
                                                    <td class="text-sm text-gray-900 font-light px-6 py-4">
                                                        {{ user.username }}
                                                    </td>
                                                    <td class="text-sm text-gray-900 font-light px-6 py-4">
                                                        {{ user.phone }}
                                                    </td>
                                                    <td class="text-sm text-gray-900 font-light px-6 py-4">
                                                        {{ getActivation(user.is_active, user.activated_at) }}
                                                    </td>
                                                    <td class="text-sm text-gray-900 font-light px-6 py-4">
                                                        <SecondaryButton class="mx-1">
                                                            <Link :href="route('users.edit', user)">View</Link>
                                                        </SecondaryButton>
                                                        <DangerButton class="mx-1" @click="deleteItem(user)">
                                                            Delete
                                                        </DangerButton>
                                                    </td>
                                                </tr>
                                                <tr v-if="users.data.length === 0">
                                                    <td class="px-6 py-4 border-t text-center" colspan="6">
                                                        No users found.
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <Pagination class="mt-6" :links="users.links" :from="users.from" :to="users.to"
                                        :total="users.total" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
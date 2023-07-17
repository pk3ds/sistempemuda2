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
        meetings: Object,
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
                this.$inertia.get(route("sessions"), pickBy(this.form), {
                    preserveState: true,
                });
            }, 150),
        },
    },
    methods: {
        deleteItem(item) {
            if (confirm('Are you sure you want to delete "' + item.name + ' (' + this.formatDate(item.start_at) + ')"?'))
                this.$inertia.delete(route('sessions.destroy', item.id));
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
    },
};
</script>

<template>

    <Head title="Sessions" />

    <AuthenticatedLayout :auth="$page.props.auth">
        <div class="pt-8 pb-2">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="lg:px-6 flex justify-between border-b pb-2">
                            <h4 class="text-lg mt-2 mr-2">Sessions</h4>
                            <SearchFilter v-model="form.search" class="mr-4 w-full max-w-md">
                            </SearchFilter>
                            <PrimaryButton>
                                <Link :href="route('sessions.create')">Add</Link>
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
                                                        Unique ID
                                                    </th>
                                                    <th scope="col"
                                                        class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                        Start
                                                    </th>
                                                    <th scope="col"
                                                        class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                        End
                                                    </th>
                                                    <th scope="col"
                                                        class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                        Action
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="meeting in meetings.data"
                                                    class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
                                                    <td class="text-sm text-gray-900 font-light px-6 py-4">
                                                        <Link :href="route('sessions.edit', meeting)">{{ meeting.name }}
                                                        </Link>
                                                    </td>
                                                    <td class="text-sm text-gray-900 font-light px-6 py-4">
                                                        {{ meeting.uuid }}
                                                    </td>
                                                    <td class="text-sm text-gray-900 font-light px-6 py-4">
                                                        {{ formatDate(meeting.start_at) }}
                                                    </td>
                                                    <td class="text-sm text-gray-900 font-light px-6 py-4">
                                                        {{ formatDate(meeting.end_at) }}
                                                    </td>
                                                    <td class="text-sm text-gray-900 font-light px-6 py-4">
                                                        <SecondaryButton class="mx-1">
                                                            <Link :href="route('sessions.edit', meeting)">View</Link>
                                                        </SecondaryButton>
                                                        <DangerButton class="mx-1" @click="deleteItem(meeting)">
                                                            Delete
                                                        </DangerButton>
                                                    </td>
                                                </tr>
                                                <tr v-if="meetings.data.length === 0">
                                                    <td class="px-6 py-4 border-t text-center" colspan="5">
                                                        No sessions found.
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <Pagination class="mt-6" :links="meetings.links" :from="meetings.from"
                                        :to="meetings.to" :total="meetings.total" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
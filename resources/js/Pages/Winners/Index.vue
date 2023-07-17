<script>
import { Head, Link } from "@inertiajs/inertia-vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import Pagination from '@/Components/Pagination.vue';

export default {
    components: {
        Head,
        Link,
        AuthenticatedLayout,
        PrimaryButton,
        SecondaryButton,
        Pagination,
    },
    props: {
        winners: Object,
    },
    data() {
        return {};
    },
    methods: {
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
        getClaimDate(boolean, date) {
            return boolean ? this.formatDate(date) : 'Not available'
        },
        claim(id) {
            this.$inertia.put(route('winners.claim', id));
        }
    },
};
</script>

<template>

    <Head title="Winners" />

    <AuthenticatedLayout :auth="$page.props.auth">
        <div class="pt-8 pb-2">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="lg:px-6 flex justify-between border-b pb-2">
                            <h4 class="text-lg mt-2 mr-2">Winners</h4>
                            <PrimaryButton>
                                <Link :href="route('draws.winners')">Winners Page</Link>
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
                                                        #
                                                    </th>
                                                    <th scope="col"
                                                        class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                        Name
                                                    </th>
                                                    <th scope="col"
                                                        class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                        Prize
                                                    </th>
                                                    <th scope="col"
                                                        class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                        Status
                                                    </th>
                                                    <th scope="col"
                                                        class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                        Claim Date
                                                    </th>
                                                    <th scope="col"
                                                        class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                        Action
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(winner, index) in winners"
                                                    class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
                                                    <td class="text-sm text-gray-900 font-light px-6 py-4">
                                                        {{ index+ 1 }}
                                                    </td>
                                                    <td class="text-sm text-gray-900 font-light px-6 py-4">
                                                        <Link :href="route('winners.edit', winner)">{{
                                                            winner.user.name
                                                        }}
                                                        </Link>
                                                    </td>
                                                    <td class="text-sm text-gray-900 font-light px-6 py-4">
                                                        {{ winner.prize }}
                                                    </td>
                                                    <td class="text-sm text-gray-900 font-light px-6 py-4">
                                                        {{ winner.is_claimed ? 'Claimed' : 'Not claimed' }}
                                                    </td>
                                                    <td class="text-sm text-gray-900 font-light px-6 py-4">
                                                        {{ getClaimDate(winner.is_claimed, winner.claimed_at) }}
                                                    </td>
                                                    <td class="text-sm text-gray-900 font-light px-6 py-4">
                                                        <SecondaryButton class="mx-1">
                                                            <Link :href="route('winners.edit', winner)">View</Link>
                                                        </SecondaryButton>
                                                        <PrimaryButton v-if="!winner.is_claimed" class="mx-1"
                                                            @click="claim(winner.id)">
                                                            Claim
                                                        </PrimaryButton>
                                                    </td>
                                                </tr>
                                                <tr v-if="winners.length === 0">
                                                    <td class="px-6 py-4 border-t text-center" colspan="5">
                                                        No winners found.
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
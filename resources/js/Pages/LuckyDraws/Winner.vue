<script>
import { Head } from "@inertiajs/inertia-vue3";

export default {
    components: {
        Head,
    },
    props: {
        winners: Object
    },
    data() {
        return {
        };
    },
    methods: {
    },
}
</script>

<style>
body {
    background-image: url('/assets/images/dinner-bg.jpg');
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    background-attachment: fixed;
}
</style>

<template>

    <Head title="Lucky Draw" />

    <div class="px-2 sm:px-24 py-24 mx-auto">
        <div class="mt-8 bg-gradient-to-r from-pink-400 to-purple-400 rounded-lg overflow-hidden shadow-sm rounded-lg">
            <div class="p-6 text-gray-900">
                <p v-if="winners.length === 0" class="md:text-2xl text-xl font-bold text-center px-3">
                    No Lucky Draw Running
                </p>
                <p v-if="winners.length !== 0" class="md:text-2xl text-xl font-bold text-center px-3">
                    Lucky Draw Winners
                </p>
                <div v-if="winners.length !== 0" class="flex flex-col">
                    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="overflow-hidden rounded">
                                <table class="min-w-full">
                                    <thead class="border-b border-black">
                                        <tr>
                                            <th scope="col"
                                                class="text-md font-extrabold text-gray-900 px-6 py-4 text-left">
                                                #
                                            </th>
                                            <th scope="col"
                                                class="text-md font-extrabold text-gray-900 px-6 py-4 text-left">
                                                Name
                                            </th>
                                            <th scope="col"
                                                class="text-md font-extrabold text-gray-900 px-6 py-4 text-left">
                                                Prize
                                            </th>
                                            <th scope="col"
                                                class="text-md font-extrabold text-gray-900 px-6 py-4 text-left">
                                                Status
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(winner, index) in winners" class="border-b border-black">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ index+ 1 }}</td>
                                            <td class="text-sm text-gray-900 font-bold px-6 py-4 whitespace-nowrap">
                                                {{ winner.user.name }}
                                            </td>
                                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                {{ winner.prize }}
                                            </td>
                                            <td v-if="winner.is_claimed"
                                                class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap flex">
                                                <svg class="text-gray-800 mr-3 w-5 h-5"
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                                    fill="currentColor">
                                                    <path
                                                        d="M190.5 68.8L225.3 128H224 152c-22.1 0-40-17.9-40-40s17.9-40 40-40h2.2c14.9 0 28.8 7.9 36.3 20.8zM64 88c0 14.4 3.5 28 9.6 40H32c-17.7 0-32 14.3-32 32v64c0 17.7 14.3 32 32 32H480c17.7 0 32-14.3 32-32V160c0-17.7-14.3-32-32-32H438.4c6.1-12 9.6-25.6 9.6-40c0-48.6-39.4-88-88-88h-2.2c-31.9 0-61.5 16.9-77.7 44.4L256 85.5l-24.1-41C215.7 16.9 186.1 0 154.2 0H152C103.4 0 64 39.4 64 88zm336 0c0 22.1-17.9 40-40 40H288h-1.3l34.8-59.2C329.1 55.9 342.9 48 357.8 48H360c22.1 0 40 17.9 40 40zM32 288V464c0 26.5 21.5 48 48 48H224V288H32zM288 512H432c26.5 0 48-21.5 48-48V288H288V512z" />
                                                </svg>
                                                <p>Claimed</p>
                                            </td>
                                            <td v-if="!winner.is_claimed"
                                                class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap flex">
                                                <span class="animate-ping absolute">
                                                    <svg class="text-purple-800 w-5 h-5"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                                        fill="currentColor">
                                                        <path
                                                            d="M190.5 68.8L225.3 128H224 152c-22.1 0-40-17.9-40-40s17.9-40 40-40h2.2c14.9 0 28.8 7.9 36.3 20.8zM64 88c0 14.4 3.5 28 9.6 40H32c-17.7 0-32 14.3-32 32v64c0 17.7 14.3 32 32 32H480c17.7 0 32-14.3 32-32V160c0-17.7-14.3-32-32-32H438.4c6.1-12 9.6-25.6 9.6-40c0-48.6-39.4-88-88-88h-2.2c-31.9 0-61.5 16.9-77.7 44.4L256 85.5l-24.1-41C215.7 16.9 186.1 0 154.2 0H152C103.4 0 64 39.4 64 88zm336 0c0 22.1-17.9 40-40 40H288h-1.3l34.8-59.2C329.1 55.9 342.9 48 357.8 48H360c22.1 0 40 17.9 40 40zM32 288V464c0 26.5 21.5 48 48 48H224V288H32zM288 512H432c26.5 0 48-21.5 48-48V288H288V512z" />
                                                    </svg>
                                                </span>
                                                <span class="relative inline-flex">
                                                    <svg class="text-purple-800 w-5 h-5"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                                        fill="currentColor">
                                                        <path
                                                            d="M190.5 68.8L225.3 128H224 152c-22.1 0-40-17.9-40-40s17.9-40 40-40h2.2c14.9 0 28.8 7.9 36.3 20.8zM64 88c0 14.4 3.5 28 9.6 40H32c-17.7 0-32 14.3-32 32v64c0 17.7 14.3 32 32 32H480c17.7 0 32-14.3 32-32V160c0-17.7-14.3-32-32-32H438.4c6.1-12 9.6-25.6 9.6-40c0-48.6-39.4-88-88-88h-2.2c-31.9 0-61.5 16.9-77.7 44.4L256 85.5l-24.1-41C215.7 16.9 186.1 0 154.2 0H152C103.4 0 64 39.4 64 88zm336 0c0 22.1-17.9 40-40 40H288h-1.3l34.8-59.2C329.1 55.9 342.9 48 357.8 48H360c22.1 0 40 17.9 40 40zM32 288V464c0 26.5 21.5 48 48 48H224V288H32zM288 512H432c26.5 0 48-21.5 48-48V288H288V512z" />
                                                    </svg>
                                                </span>
                                                <p class="ml-3">Not claimed</p>
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

</template>

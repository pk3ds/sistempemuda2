<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Accordion from "@/Components/Accordion.vue";
import { Head } from '@inertiajs/inertia-vue3';

const formatDate = (date) => {
    return new Intl
        .DateTimeFormat('en-my', {
            dateStyle: 'medium',
            timeStyle: 'short',
            timeZone: 'Asia/Kuala_Lumpur',
            hour12: false,
        })
        .format(new Date(date));
}

const props = defineProps({
    checkins: Object,
    awards: Object,
});
</script>

<style>
.background-radial {
    background-image: url('/assets/images/bg-04.png');
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}
</style>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div class="pt-8 pb-2">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <section class="mb-4 text-gray-800 text-center lg:text-left">
                    <div class="w-full background-radial rounded-t-lg shadow-md">
                        <div class="flex flex-col items-center pb-10">
                            <svg class="bg-[#FF8400] p-4 w-24 h-24 mt-6 mb-3 text-white rounded-xl shadow-lg"
                                fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                                <path
                                    d="M64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V64c0-35.3-28.7-64-64-64H64zm96 320h64c44.2 0 80 35.8 80 80c0 8.8-7.2 16-16 16H96c-8.8 0-16-7.2-16-16c0-44.2 35.8-80 80-80zm96-96c0 35.3-28.7 64-64 64s-64-28.7-64-64s28.7-64 64-64s64 28.7 64 64zM144 64h96c8.8 0 16 7.2 16 16s-7.2 16-16 16H144c-8.8 0-16-7.2-16-16s7.2-16 16-16z" />
                            </svg>
                            <h5 class="mb-1 text-xl font-medium text-white">
                                {{ $page.props.auth.user.name }}
                            </h5>
                            <span class="text-sm text-gray-300">
                                <p>{{ $page.props.auth.user.email }}</p>
                            </span>
                            <div class="flex mt-4 space-x-6 md:mt-6">
                                <span
                                    class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                                    {{ $page.props.auth.user.points }} points
                                </span>
                                <a href="https://www.tmonearea.com/" target="_blank"
                                    class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                                    Info Pack
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="w-full bg-white rounded-b-lg shadow-md">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 p-8">
                            <Accordion>
                                <template v-slot:title>
                                    <span class="font-semibold text-lg my-2">Check In History</span>
                                </template>
                                <template v-slot:content>
                                    <ol class="border-l-2 border-blue-600">
                                        <li v-for="checkin in checkins">
                                            <div class="flex flex-start items-center">
                                                <div
                                                    class="bg-blue-600 w-4 h-4 flex items-center justify-center rounded-full -ml-2 mr-3 -mt-2">
                                                </div>
                                                <h4 class="text-gray-800 font-semibold text-md -mt-2">{{
                                                    checkin.meeting.name
                                                }}
                                                </h4>
                                            </div>
                                            <div class="ml-6 mb-1">
                                                <span
                                                    class="text-blue-600 hover:text-blue-700 focus:text-blue-800 duration-300 transition ease-in-out text-sm">
                                                    {{ formatDate(checkin.created_at) }}
                                                </span>
                                                <p class="text-gray-700 mt-2 mb-4">{{ checkin.meeting.description }}</p>
                                            </div>
                                        </li>
                                    </ol>
                                    <p class="text-left" v-if="checkins.length === 0">
                                        No check in history
                                    </p>
                                </template>
                            </Accordion>

                            <Accordion>
                                <template v-slot:title>
                                    <span class="font-semibold text-lg my-2">User Awards</span>
                                </template>
                                <template v-slot:content>
                                    <span v-for="award in awards"
                                        class="flex p-4 m-4 rounded-full text-blue-600 bg-gray-200 font-semibold text-sm">
                                        <svg class="rounded-full w-12 h-12 max-w-none" fill="currentColor"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                                            <path
                                                d="M173.8 5.5c11-7.3 25.4-7.3 36.4 0L228 17.2c6 3.9 13 5.8 20.1 5.4l21.3-1.3c13.2-.8 25.6 6.4 31.5 18.2l9.6 19.1c3.2 6.4 8.4 11.5 14.7 14.7L344.5 83c11.8 5.9 19 18.3 18.2 31.5l-1.3 21.3c-.4 7.1 1.5 14.2 5.4 20.1l11.8 17.8c7.3 11 7.3 25.4 0 36.4L366.8 228c-3.9 6-5.8 13-5.4 20.1l1.3 21.3c.8 13.2-6.4 25.6-18.2 31.5l-19.1 9.6c-6.4 3.2-11.5 8.4-14.7 14.7L301 344.5c-5.9 11.8-18.3 19-31.5 18.2l-21.3-1.3c-7.1-.4-14.2 1.5-20.1 5.4l-17.8 11.8c-11 7.3-25.4 7.3-36.4 0L156 366.8c-6-3.9-13-5.8-20.1-5.4l-21.3 1.3c-13.2 .8-25.6-6.4-31.5-18.2l-9.6-19.1c-3.2-6.4-8.4-11.5-14.7-14.7L39.5 301c-11.8-5.9-19-18.3-18.2-31.5l1.3-21.3c.4-7.1-1.5-14.2-5.4-20.1L5.5 210.2c-7.3-11-7.3-25.4 0-36.4L17.2 156c3.9-6 5.8-13 5.4-20.1l-1.3-21.3c-.8-13.2 6.4-25.6 18.2-31.5l19.1-9.6C65 70.2 70.2 65 73.4 58.6L83 39.5c5.9-11.8 18.3-19 31.5-18.2l21.3 1.3c7.1 .4 14.2-1.5 20.1-5.4L173.8 5.5zM272 192c0-44.2-35.8-80-80-80s-80 35.8-80 80s35.8 80 80 80s80-35.8 80-80zM1.3 441.8L44.4 339.3c.2 .1 .3 .2 .4 .4l9.6 19.1c11.7 23.2 36 37.3 62 35.8l21.3-1.3c.2 0 .5 0 .7 .2l17.8 11.8c5.1 3.3 10.5 5.9 16.1 7.7l-37.6 89.3c-2.3 5.5-7.4 9.2-13.3 9.7s-11.6-2.2-14.8-7.2L74.4 455.5l-56.1 8.3c-5.7 .8-11.4-1.5-15-6s-4.3-10.7-2.1-16zm248 60.4L211.7 413c5.6-1.8 11-4.3 16.1-7.7l17.8-11.8c.2-.1 .4-.2 .7-.2l21.3 1.3c26 1.5 50.3-12.6 62-35.8l9.6-19.1c.1-.2 .2-.3 .4-.4l43.2 102.5c2.2 5.3 1.4 11.4-2.1 16s-9.3 6.9-15 6l-56.1-8.3-32.2 49.2c-3.2 5-8.9 7.7-14.8 7.2s-11-4.3-13.3-9.7z" />
                                        </svg>
                                        <p class="self-center">{{ award.name }}</p>
                                    </span>
                                    <p class="text-left" v-if="awards.length === 0">
                                        No award received
                                    </p>
                                </template>
                            </Accordion>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

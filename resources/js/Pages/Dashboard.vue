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

// const props = defineProps({
//     checkins: Object,
//     awards: Object,
// });
</script>

<style>
.background-radial {
    background-image: url('/assets/images/bg-06.jpg');
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
                            <h5 class="mb-1 text-xl font-medium text-black">
                                {{ $page.props.auth.user.name }}
                            </h5>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <!-- donation's cards -->
        <div class="pt-5 pb-2">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <a href="#">
                        <img class="rounded-t-lg" src="/assets/images/bg-06.jpg" alt="" />
                    </a>
                    <div class="p-5">
                        <a href="#">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Noteworthy technology acquisitions 2021</h5>
                        </a>
                        <!-- <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Here are the biggest enterprise technology acquisitions of 2021 so far, in reverse chronological order.</p> -->
                        <div class="bg-slate-600 py-3 mb-2">
                            <div class="mx-3 flex justify-between">
                                <h3 class="text-white">RM 200</h3>
                                <h3 class="text-slate-400">of RM 400</h3>
                            </div>
                            <div class="mx-2">
                                <div class="w-full bg-gray-200 rounded-full dark:bg-gray-700">
                                    <div class="bg-blue-600 text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full" style="width: 45%"> 45%</div>
                                </div>
                            </div>
                        </div>
                        <a href="#" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Sumbang
                            <div class="ml-2">
                                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                </svg>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="pt-8 pb-2">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                    <div class="bg-purple-600 h-2.5 rounded-full dark:bg-purple-500" style="width: 45%"></div>
                </div>
                <br>
                
                <br>

                <!-- <div class="container bg-primary">
                    
                </div> -->
                <!-- <h2>
                    test
                </h2> -->
            </div>
        </div>
    </AuthenticatedLayout>
</template>

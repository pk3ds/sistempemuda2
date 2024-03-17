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
        <div class="pt-8 pb-2">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- <div class="container bg-primary">
                    
                </div> -->
                <!-- <h2>
                    test
                </h2> -->
            </div>
        </div>
    </AuthenticatedLayout>
</template>

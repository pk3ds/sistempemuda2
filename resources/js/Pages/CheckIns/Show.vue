<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';

const props = defineProps({
    meeting: Object,
    checkIn: Object,
});

const form = useForm();

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
</script>

<template>
    <GuestLayout>

        <Head title="Check In" />

        <div class="text-lg font-bold text-gray-600">{{ meeting.name }} Check In</div>
        <p class="mb-4 text-sm text-gray-600">
            {{ formatDate(meeting.start_at) }} until {{ formatDate(meeting.end_at) }}
        </p>

        <div class="mb-4 flex items-start">
            <div class="shrink-0">
                <div class="ml-2 mt-2 p-4 bg-blue-600 rounded-md shadow-md w-14 h-14 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" fill="white">
                        <path
                            d="M64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H512c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm80 256h64c44.2 0 80 35.8 80 80c0 8.8-7.2 16-16 16H80c-8.8 0-16-7.2-16-16c0-44.2 35.8-80 80-80zm96-96c0 35.3-28.7 64-64 64s-64-28.7-64-64s28.7-64 64-64s64 28.7 64 64zm128-32H496c8.8 0 16 7.2 16 16s-7.2 16-16 16H368c-8.8 0-16-7.2-16-16s7.2-16 16-16zm0 64H496c8.8 0 16 7.2 16 16s-7.2 16-16 16H368c-8.8 0-16-7.2-16-16s7.2-16 16-16zm0 64H496c8.8 0 16 7.2 16 16s-7.2 16-16 16H368c-8.8 0-16-7.2-16-16s7.2-16 16-16z" />
                    </svg>
                </div>
            </div>
            <div class="grow ml-6">
                <p class="font-bold mb-1">{{ $page.props.auth.user.name }}</p>
                <p class="text-gray-500">{{ $page.props.auth.user.email }}</p>
                <p class="text-gray-500">{{ $page.props.auth.user.staff_id }}</p>
            </div>
        </div>

        <div v-if="$page.props.flash.status" class="mb-4 text-sm text-gray-600">
            <p class="font-bold">{{ $page.props.flash.status }}</p>
            <p class="mb-3">Check in time: <span class="font-semibold">{{ formatDate(checkIn.created_at) }}</span></p>
            <p>Here are some links that might be useful for you:</p>
            <ul class="list-disc mx-4">
                <li>
                    <a href="https://www.tmonearea.com/" target="_blank"
                        class="hover:text-gray-900 underline focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Info Pack
                    </a>
                </li>
                <li>
                    <Link :href="route('dashboard')"
                        class="hover:text-gray-900 underline focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Dashboard</Link>
                </li>
            </ul>
        </div>

        <div v-if="!$page.props.flash.status" class="mb-4 text-sm text-gray-600">
            <p class="font-bold">Already checked in! Sit back and enjoy the session.</p>
            <p class="mb-3">Check in time: <span class="font-semibold">{{ formatDate(checkIn.created_at) }}</span></p>
            <p>Here are some links that might be useful for you:</p>
            <ul class="list-disc mx-4">
                <li>
                    <a href="https://www.tmonearea.com/" target="_blank"
                        class="hover:text-gray-900 underline focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Info Pack
                    </a>
                </li>
                <li>
                    <Link :href="route('dashboard')"
                        class="hover:text-gray-900 underline focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Dashboard</Link>
                </li>
            </ul>
        </div>

        <form>
            <div class="mt-4 flex items-center justify-between">
                <span></span>

                <span class="text-sm text-gray-600 rounded-md">
                    Not you?
                    <Link :href="route('logout')" method="post" as="button"
                        class="hover:text-gray-900 underline focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Log Out</Link>
                </span>
            </div>
        </form>
    </GuestLayout>
</template>

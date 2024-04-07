<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import SwiperSlider from '@/Components/SwiperSlider.vue';
import DonationCard from '@/Components/DonationCard.vue';
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
    donations: Object,
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
        <!-- Profile -->
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
        
        <!-- Swiper -->
        <div class="px-20 py-10">
            <h5>Donations</h5>
            <div class="bg-white container rounded shadow">
                <div class="px-2 py-2">
                    <SwiperSlider :items="donations" />
                </div>
            </div>
        </div>

        <!-- donation's cards -->
        <!-- <div class="flex flex-row px-9">
            <div v-for="donation in donations">
                <div class="pt-5 pb-2">
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                            <div class="basis-1/3"><DonationCard :donation="donation" /></div>
                        </div>
                    </div>
            </div>
        </div> -->
        <!-- <div class="max-w-sm rounded overflow-hidden shadow-lg">
            <img class="w-full" src="/img/card-top.jpg" alt="Sunset in the mountains">
            <div class="px-6 py-4">
                <div class="font-bold text-xl mb-2">The Coldest Sunset</div>
                <p class="text-gray-700 text-base">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus quia, nulla! Maiores et perferendis eaque, exercitationem praesentium nihil.
                </p>
            </div>
            <div class="px-6 pt-4 pb-2">
                <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#photography</span>
                <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#travel</span>
                <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#winter</span>
            </div>
        </div> -->
        <!-- <div class="pt-5 pb-2">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-flow-col gap-3">
                    <div class="col-span-1">
                        <div class="mb-5 w-80 rounded shadow-lg">
                            <div class="h-[200px] w-[200-px]">
                                <img class="object-fill h-48 w-96 rounded" v-bind:src="'/storage/uploads/NH2r2ZVb9BDsnNXspyR5Pup8XnjZNkvwQOawRNxg.jpg'" alt="Sunset in the mountains">
                            </div>
                            <div class="px-4 py-4">
                                <div class="font-bold text-xl mb-2">The Coldest Sunset</div>
                                <p class="text-gray-700 text-base">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus quia, nulla! Maiores et perferendis eaque, exercitationem praesentium nihil.
                                </p>
                            </div>
                            <div class="px-4 pb-2">
                                <div class=" bg-slate-600 rounded px-3 py-2 text-sm font-semibold text-gray-700 mr-2 mb-2">
                                    <div class="mx-3 flex justify-between">
                                        <h3 class="text-white">RM 0</h3>
                                        <h3 class="text-slate-400">of RM 1000</h3>
                                    </div>
                                    <div class="mx-2">
                                        <div class="w-full bg-gray-200 rounded-full dark:bg-gray-700">
                                            <div class="bg-blue-600 text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full" style="width: 45%"> 45%</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="py-2 grid justify-items-center">
                                <a href="#" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    Sumbang
                                    <div class="ml-2">
                                        <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                        </svg>
                                    </div>
                                </a>
                                <button class="bg-transparent hover:bg-blue-500 text-blue-700
                                 hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded text-sm font-medium text-center">
                                    Details
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-1">
                        <div class="mb-5 w-96 rounded shadow-lg">
                            <div class="h-[200px] w-[200-px]">
                                <img class="object-fill h-48 w-96 rounded" v-bind:src="'/storage/uploads/5BUx8hJAV4KaI5CooV7yAesCeLjerC1xZMx8wn5U.png'" alt="Sunset in the mountains">
                            </div>
                            <div class="px-6 py-4">
                                <div class="font-bold text-xl mb-2">The Coldest Sunset</div>
                                <p class="text-gray-700 text-base">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus quia, nulla! Maiores et perferendis eaque, exercitationem praesentium nihil.
                                </p>
                            </div>
                            <div class="px-6 pb-2">
                                <div class=" bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">
                                    <div class="mx-3 flex justify-between">
                                        <h3 class="text-white">RM 0</h3>
                                        <h3 class="text-slate-400">of RM 1000</h3>
                                    </div>
                                    <div class="mx-2">
                                        <div class="w-full bg-gray-200 rounded-full dark:bg-gray-700">
                                            <div class="bg-blue-600 text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full" style="width: 45%"> 45%</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-1">
                        <div class="w-96 rounded shadow-lg">
                            <img class="w-full" v-bind:src="'/storage/uploads/NH2r2ZVb9BDsnNXspyR5Pup8XnjZNkvwQOawRNxg.jpg'" alt="Sunset in the mountains">
                            <div class="px-6 py-4">
                                <div class="font-bold text-xl mb-2">The Coldest Sunset</div>
                                <p class="text-gray-700 text-base">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus quia, nulla! Maiores et perferendis eaque, exercitationem praesentium nihil.
                                </p>
                            </div>
                            <div class="px-6 pt-4 pb-2">
                                <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#photography</span>
                                <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#travel</span>
                                <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#winter</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="grid grid-flow-col gap-4">
                    <div class="col-span-1">
                        <DonationCard />
                    </div>
                    <div class="col-span-1">
                        <DonationCard />
                    </div>
                    <div class="col-span-1">
                        <DonationCard />
                    </div>
                </div>
            </div>
        </div> -->
    </AuthenticatedLayout>
</template>

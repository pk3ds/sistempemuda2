<script>
export default {
    props: {
        donation: Object
    }
}
</script>

<template>
    <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <a href="#">
            <img class="rounded-t-lg" v-bind:src="'/storage/' + donation.uploaded_file.path" alt="" />
        </a>
        <div class="p-5">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ donation.name }}</h5>
            <a href="#">
            </a>
            <!-- <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Here are the biggest enterprise technology acquisitions of 2021 so far, in reverse chronological order.</p> -->
            <div class="bg-slate-600 py-3 mb-2">
                <div class="mx-3 flex justify-between">
                    <h3 class="text-white">RM 0</h3>
                    <h3 class="text-slate-400">of RM {{ donation.target }}</h3>
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
</template>

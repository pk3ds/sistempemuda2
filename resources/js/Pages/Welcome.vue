<script setup>
import DonationCardVue from "@/Components/DonationCard.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/inertia-vue3";

const props = defineProps({
    leaderboards: Object,
    groups: Object,
});
</script>

<style>
#pricing-block-5 {
    height: 300px;
    padding-top: 55px;
}

@media (min-width: 992px) {
    #pricing-block-5 {
        height: 400px;
        padding-top: 80px;
    }
}

.background-radial-gradient {
    background-image: url('/assets/images/bg-04.png');
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}
</style>

<template>
    <Head title="Home" />

    <AuthenticatedLayout>
        <div class="pt-8">
            <div class="max-w-7xl mx-auto rounded-lg">
                <DonationCardVue v-if="false"/>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

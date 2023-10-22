<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import QRModal from '@/Components/QRModal.vue';
import { Link, useForm, Head } from '@inertiajs/inertia-vue3';
import Datepicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css';
import QRCodeVue3 from "qrcode-vue3";
import { ref } from 'vue';
import { saveAsJpeg } from 'save-html-as-image';
import Accordion from "@/Components/Accordion.vue";
import { Inertia } from '@inertiajs/inertia';
import Checkbox from '@/Components/Checkbox.vue';

function back() {
    window.history.back();
};

function calculateAttendance() {
    Inertia.post(route('checkins.calculate', props.meeting));
};

const showModal = ref(false);

const openModal = () => {
    showModal.value = true;
};

const closeModal = () => {
    showModal.value = false;
};

const downloadQr = () => {
    const node = document.getElementById('qr-code');
    saveAsJpeg(node, { filename: `QR - ${props.meeting.name}`, printDate: false });
};

const props = defineProps({
    meeting: Object,
});

const form = useForm({
    name: props.meeting.name,
    description: props.meeting.description,
    start_at: props.meeting.start_at,
    end_at: props.meeting.end_at,
    ahli: props.meeting.ahli === 1,
});
</script>

<template>
    <Head title="Edit Session" />

    <AuthenticatedLayout>

        <div v-if="meeting.deleted_at"
            class="bg-yellow-100 rounded-b-lg py-5 px-6 mb-3 text-base text-yellow-700 inline-flex items-center w-full"
            role="alert">
            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="exclamation-triangle"
                class="w-4 h-4 mr-2 fill-current" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                <path fill="currentColor"
                    d="M569.517 440.013C587.975 472.007 564.806 512 527.94 512H48.054c-36.937 0-59.999-40.055-41.577-71.987L246.423 23.985c18.467-32.009 64.72-31.951 83.154 0l239.94 416.028zM288 354c-25.405 0-46 20.595-46 46s20.595 46 46 46 46-20.595 46-46-20.595-46-46-46zm-43.673-165.346l7.418 136c.347 6.364 5.609 11.346 11.982 11.346h48.546c6.373 0 11.635-4.982 11.982-11.346l7.418-136c.375-6.874-5.098-12.654-11.982-12.654h-63.383c-6.884 0-12.356 5.78-11.981 12.654z">
                </path>
            </svg>
            This session has been deleted from the system, all records are for viewing only
        </div>

        <div class="pt-8 pb-2">
            <div class="mt-4 md:mt-0 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <Accordion :open="true">
                        <template v-slot:title>
                            <span class="font-semibold text-lg my-2">Edit Session</span>
                        </template>
                        <template v-slot:content>
                            <section>
                                <header>
                                    <div class="flex justify-between">
                                        <span>
                                            <p class="mt-1 text-sm text-gray-600">
                                                View or edit sessions for the event.
                                            </p>
                                        </span>
                                        <PrimaryButton @click="openModal"
                                            v-if="!meeting.deleted_at && new Date() < new Date(meeting.end_at)">QR Code
                                        </PrimaryButton>
                                        <PrimaryButton
                                            v-if="new Date() > new Date(meeting.end_at) && meeting.scores.length === 0"
                                            @click="calculateAttendance">
                                            Calculate Attendance
                                        </PrimaryButton>
                                        <span v-if="meeting.deleted_at" class="text-gray-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="25"
                                                height="25" fill="currentColor">
                                                <path
                                                    d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z" />
                                            </svg>
                                        </span>
                                    </div>
                                </header>

                                <form @submit.prevent="form.patch(route('sessions.update', meeting))"
                                    class="mt-6 space-y-6">
                                    <div>
                                        <InputLabel for="name" value="Name" />

                                        <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name"
                                            required :readonly="meeting.deleted_at" autofocus autocomplete="name" />

                                        <InputError class="mt-2" :message="form.errors.name" />
                                    </div>

                                    <div>
                                        <InputLabel for="description" value="Description" />

                                        <TextInput id="description" type="text" class="mt-1 block w-full"
                                            v-model="form.description" autocomplete="description"
                                            :readonly="meeting.deleted_at" />

                                        <InputError class="mt-2" :message="form.errors.description" />
                                    </div>

                                    <!-- FIXME use range for future version -->
                                    <div>
                                        <InputLabel for="start_at" value="Start" />

                                        <Datepicker v-model="form.start_at" :format="'dd MMM yyyy, HH:mm'" required
                                            :readonly="meeting.deleted_at">
                                        </Datepicker>

                                        <InputError class="mt-2" :message="form.errors.start_at" />
                                    </div>

                                    <div>
                                        <InputLabel for="end_at" value="End" />

                                        <Datepicker v-model="form.end_at" :format="'dd MMM yyyy, HH:mm'" required
                                            :readonly="meeting.deleted_at">
                                        </Datepicker>

                                        <InputError class="mt-2" :message="form.errors.end_at" />
                                    </div>

                                    <div class="block mt-4">
                                        <label class="flex items-center">
                                            <Checkbox name="ahli" v-model:checked="form.ahli" />
                                            <span class="ml-2 text-sm text-gray-600">ahli?</span>
                                        </label>
                                    </div>

                                    <div class="flex items-center gap-4">
                                        <PrimaryButton v-if="!meeting.deleted_at" :disabled="form.processing">Update
                                        </PrimaryButton>
                                        <SecondaryButton @click="back">
                                            Cancel
                                        </SecondaryButton>
                                    </div>
                                </form>
                            </section>
                        </template>
                    </Accordion>
                </div>
            </div>
        </div>

    </AuthenticatedLayout>

    <QRModal :show="showModal" @close="closeModal">
        <div class="p-6">
            <h2 class="text-lg text-center font-medium text-gray-900 mb-2">
                {{ meeting.name }}
            </h2>

            <div class="flex justify-center" id="qr-code">
                <QRCodeVue3 :width="1000" :height="1000" :value="route('checkins.create', meeting)"
                    :qrOptions="{ typeNumber: 0, mode: 'Byte', errorCorrectionLevel: 'H' }"
                    :image="'/assets/images/logo.png'"
                    :imageOptions="{ hideBackgroundDots: true, imageSize: 0.4, margin: 0 }" :dotsOptions="{
                        type: 'dots',
                        color: '#2362dd',
                        gradient: {
                            type: 'linear',
                            rotation: 0,
                            colorStops: [
                                { offset: 0, color: '#2362dd' },
                                { offset: 1, color: '#2362dd' },
                            ],
                        },
                    }" :backgroundOptions="{ color: '#ffffff' }"
                    :cornersSquareOptions="{ type: 'extra-rounded', color: '#26249a' }"
                    :cornersDotOptions="{ type: 'rounded', color: '#26249a' }" />
            </div>

            <div class="mt-6 flex justify-center">
                <PrimaryButton @click="downloadQr" class="mx-4"> Download </PrimaryButton>
                <SecondaryButton class="mx-4">
                    <Link :href="route('checkins.create', meeting)">Link</Link>
                </SecondaryButton>
                <SecondaryButton @click="closeModal" class="mx-4"> Close </SecondaryButton>
            </div>
        </div>
    </QRModal>
</template>

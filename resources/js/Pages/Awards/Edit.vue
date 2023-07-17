<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import SelectInput from '@/Components/SelectInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import Accordion from "@/Components/Accordion.vue";
import { Link, Head } from '@inertiajs/inertia-vue3';

export default {
    components: {
        AuthenticatedLayout,
        InputError,
        InputLabel,
        TextInput,
        SelectInput,
        PrimaryButton,
        SecondaryButton,
        Link,
        Head,
        Accordion,
    },
    props: {
        award: Object,
        meetings: Object,
        groups: Object,
        users: Object,
    },
    remember: "form",
    data() {
        return {
            recipients: [],
            form: this.$inertia.form({
                meeting_id: this.award.meeting_id,
                name: this.award.name,
                remark: this.award.remark,
                points: this.award.points,
                recipient_type: this.replaceSlash(this.award.awardable_type),
                recipient_id: this.award.awardable_id,
            }),
        };
    },
    mounted() {
        this.loadRecipients(this.replaceSlash(this.award.awardable_type));
    },
    methods: {
        replaceSlash(string) {
            return encodeURI(string).replaceAll("%5C", "");
        },
        loadRecipients(type) {
            if (type === 'AppModelsGroup') {
                this.recipients = this.groups;
            } else if (type === 'AppModelsUser') {
                this.recipients = this.users;
            }
        },
        back() {
            window.history.back();
        },
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
    },
};
</script>

<template>

    <Head title="Edit Award" />

    <AuthenticatedLayout>

        <div v-if="award.deleted_at"
            class="bg-yellow-100 rounded-b-lg py-5 px-6 mb-3 text-base text-yellow-700 inline-flex items-center w-full"
            role="alert">
            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="exclamation-triangle"
                class="w-4 h-4 mr-2 fill-current" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                <path fill="currentColor"
                    d="M569.517 440.013C587.975 472.007 564.806 512 527.94 512H48.054c-36.937 0-59.999-40.055-41.577-71.987L246.423 23.985c18.467-32.009 64.72-31.951 83.154 0l239.94 416.028zM288 354c-25.405 0-46 20.595-46 46s20.595 46 46 46 46-20.595 46-46-20.595-46-46-46zm-43.673-165.346l7.418 136c.347 6.364 5.609 11.346 11.982 11.346h48.546c6.373 0 11.635-4.982 11.982-11.346l7.418-136c.375-6.874-5.098-12.654-11.982-12.654h-63.383c-6.884 0-12.356 5.78-11.981 12.654z">
                </path>
            </svg>
            This award has been deleted from the system, all records are for viewing only
        </div>

        <div class="pt-8 pb-2">
            <div class="mt-4 md:mt-0 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <Accordion>
                        <template v-slot:title>
                            <span class="font-semibold text-lg my-2">Edit Award</span>
                        </template>
                        <template v-slot:content>
                            <section>
                                <header>
                                    <div class="flex justify-between">
                                        <span>
                                            <p class="mt-1 text-sm text-gray-600">
                                                View or edit awards given.
                                            </p>
                                        </span>
                                        <span v-if="award.deleted_at" class="mt-1 text-gray-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="45"
                                                height="45" fill="currentColor">
                                                <path
                                                    d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z" />
                                            </svg>
                                        </span>
                                    </div>
                                </header>

                                <form @submit.prevent="form.patch(route('awards.update', award))"
                                    class="mt-6 space-y-6">
                                    <div>
                                        <InputLabel for="name" value="Name" />

                                        <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name"
                                            required autofocus autocomplete="name" :readonly="award.deleted_at" />

                                        <InputError class="mt-2" :message="form.errors.name" />
                                    </div>

                                    <div>
                                        <InputLabel for="remark" value="Remark" />

                                        <TextInput id="remark" type="text" class="mt-1 block w-full"
                                            v-model="form.remark" autocomplete="remark" :readonly="award.deleted_at" />

                                        <InputError class="mt-2" :message="form.errors.remark" />
                                    </div>

                                    <div>
                                        <InputLabel for="points" value="Points" />

                                        <TextInput id="points" type="number" class="mt-1 block w-full"
                                            v-model="form.points" required autocomplete="points"
                                            :readonly="award.deleted_at" />

                                        <InputError class="mt-2" :message="form.errors.points" />
                                    </div>

                                    <div>
                                        <InputLabel for="meeting_id" value="Session" />

                                        <SelectInput id="meeting_id" class="mt-1 block w-full" v-model="form.meeting_id"
                                            :disabled="award.deleted_at">
                                            <option v-for="meeting in meetings" :value="meeting.id">{{ meeting.name }}
                                            </option>
                                        </SelectInput>

                                        <InputError class="mt-2" :message="form.errors.meeting_id" />
                                    </div>

                                    <div>
                                        <InputLabel for="recipient_type" value="Recipient Type (Readonly)" />

                                        <SelectInput id="recipient_type" class="mt-1 block w-full"
                                            v-model="form.recipient_type" disabled
                                            @change="loadRecipients(form.recipient_type)">
                                            <option value="AppModelsGroup">Contingent</option>
                                            <option value="AppModelsUser">User</option>
                                        </SelectInput>

                                        <InputError class="mt-2" :message="form.errors.recipient_type" />
                                    </div>

                                    <div v-if="recipients.length !== 0">
                                        <InputLabel for="recipient_id" value="Recipient (Readonly)" />

                                        <SelectInput id="recipient_id" class="mt-1 block w-full"
                                            v-model="form.recipient_id" disabled>
                                            <option v-for="recipient in recipients" :value="recipient.id">{{
                                                recipient.name
                                            }}
                                            </option>
                                        </SelectInput>

                                        <InputError class="mt-2" :message="form.errors.recipient_id" />
                                    </div>

                                    <div class="flex items-center gap-4">
                                        <PrimaryButton v-if="!award.deleted_at" :disabled="form.processing">Update
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

        <div class="pt-8 pb-2">
            <div class="mt-4 md:mt-0 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <Accordion>
                        <template v-slot:title>
                            <span class="font-semibold text-lg my-2">Points History</span>
                        </template>
                        <template v-slot:content>
                            <ol class="border-l-2 border-blue-600">
                                <li v-for="history in award.histories">
                                    <div class="flex flex-start items-center">
                                        <div
                                            class="bg-blue-600 w-4 h-4 flex items-center justify-center rounded-full -ml-2 mr-3 -mt-2">
                                        </div>
                                        <h4 class="text-gray-800 font-semibold text-md -mt-2">{{ history.points }}</h4>
                                    </div>
                                    <div class="ml-6 mb-1">
                                        <span
                                            class="text-blue-600 hover:text-blue-700 focus:text-blue-800 duration-300 transition ease-in-out text-sm">
                                            {{ formatDate(history.created_at) }}
                                        </span>
                                        <p class="text-gray-700 mt-2 mb-4">{{ history.remark }}</p>
                                        <PrimaryButton v-if="history.link">
                                            <Link :href="history.link">View Info</Link>
                                        </PrimaryButton>
                                    </div>
                                </li>
                            </ol>
                        </template>
                    </Accordion>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

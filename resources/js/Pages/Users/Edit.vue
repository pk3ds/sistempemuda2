<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import SelectInput from '@/Components/SelectInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import Accordion from "@/Components/Accordion.vue";
import Modal from '@/Components/Modal.vue';
import { Link, useForm, Head } from '@inertiajs/inertia-vue3';
import axios from 'axios';
import { ref } from 'vue';

function back() {
    window.history.back();
};

function reset() {
    axios
        .put(route('users.reset', props.user))
        .then((response) => {
            console.log(response.data);
        }).catch((error) => {
            console.log(error.response.status);
        });
};

const showModal = ref(false);

const openModal = () => {
    showModal.value = true;
};

const closeModal = () => {
    showModal.value = false;
};

function insertPoints() {
    showModal.value = false;
    pointsForm.put(route('users.points', props.user));
    pointsForm.points = '';
};

const props = defineProps({
    user: Object,
    facilitators: Object,
    groups: Object,
    roles: Object,
});

const form = useForm({
    name: props.user.name,
    staff_id: props.user.staff_id,
    email: props.user.email,
    phone: props.user.phone,
    division: props.user.division,
    group_id: props.user.group_id,
    facilitator_id: props.user.facilitator_id,
    role_id: props.user.roles[0].id,
});

const pointsForm = useForm({
    points: '',
});

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

    <Head title="Edit User" />

    <AuthenticatedLayout>

        <div v-if="user.deleted_at"
            class="bg-yellow-100 rounded-b-lg py-5 px-6 mb-3 text-base text-yellow-700 inline-flex items-center w-full"
            role="alert">
            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="exclamation-triangle"
                class="w-4 h-4 mr-2 fill-current" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                <path fill="currentColor"
                    d="M569.517 440.013C587.975 472.007 564.806 512 527.94 512H48.054c-36.937 0-59.999-40.055-41.577-71.987L246.423 23.985c18.467-32.009 64.72-31.951 83.154 0l239.94 416.028zM288 354c-25.405 0-46 20.595-46 46s20.595 46 46 46 46-20.595 46-46-20.595-46-46-46zm-43.673-165.346l7.418 136c.347 6.364 5.609 11.346 11.982 11.346h48.546c6.373 0 11.635-4.982 11.982-11.346l7.418-136c.375-6.874-5.098-12.654-11.982-12.654h-63.383c-6.884 0-12.356 5.78-11.981 12.654z">
                </path>
            </svg>
            This user has been deleted from the system, all records are for viewing only
        </div>

        <div class="pt-8 pb-2">
            <div class="mt-4 md:mt-0 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <Accordion>
                        <template v-slot:title>
                            <span class="font-semibold text-lg my-2">Edit User</span>
                        </template>
                        <template v-slot:content>
                            <section>
                                <header>
                                    <div class="flex justify-between">
                                        <span>
                                            <p class="mt-1 text-sm text-gray-600">
                                                View or edit users for the event.
                                            </p>
                                        </span>
                                        <span v-if="user.deleted_at" class="mt-1 text-gray-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="45"
                                                height="45" fill="currentColor">
                                                <path
                                                    d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z" />
                                            </svg>
                                        </span>
                                    </div>
                                </header>

                                <form @submit.prevent="form.patch(route('users.update', user))" class="mt-6 space-y-6">
                                    <div>
                                        <InputLabel for="name" value="Name" />

                                        <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name"
                                            required :readonly="user.deleted_at" autofocus autocomplete="name" />

                                        <InputError class="mt-2" :message="form.errors.name" />
                                    </div>

                                    <div>
                                        <InputLabel for="staff_id" value="Staff ID" />

                                        <TextInput id="staff_id" type="text" class="mt-1 block w-full"
                                            v-model="form.staff_id" :readonly="user.deleted_at" required
                                            autocomplete="staff_id" />

                                        <InputError class="mt-2" :message="form.errors.staff_id" />
                                    </div>

                                    <div>
                                        <InputLabel for="email" value="Email" />

                                        <TextInput id="email" type="email" class="mt-1 block w-full"
                                            v-model="form.email" :readonly="user.deleted_at" required
                                            autocomplete="email" />

                                        <InputError class="mt-2" :message="form.errors.email" />
                                    </div>

                                    <div>
                                        <InputLabel for="phone" value="Phone" />

                                        <TextInput id="phone" type="text" class="mt-1 block w-full" v-model="form.phone"
                                            :readonly="user.deleted_at" autocomplete="phone" required />

                                        <InputError class="mt-2" :message="form.errors.phone" />
                                    </div>

                                    <div>
                                        <InputLabel for="division" value="Division" />

                                        <TextInput id="division" type="text" class="mt-1 block w-full"
                                            v-model="form.division" autocomplete="division" />

                                        <InputError class="mt-2" :message="form.errors.division" />
                                    </div>

                                    <div>
                                        <InputLabel for="group_id" value="Contingent" />

                                        <SelectInput id="group_id" class="mt-1 block w-full" v-model="form.group_id"
                                            required :disabled="user.deleted_at">
                                            <option v-for="group in groups" :value="group.id">{{ group.name }}</option>
                                        </SelectInput>

                                        <InputError class="mt-2" :message="form.errors.group_id" />
                                    </div>

                                    <div>
                                        <InputLabel for="role_id" value="Role" />

                                        <SelectInput id="role_id" class="mt-1 block w-full" v-model="form.role_id"
                                            required :disabled="user.deleted_at">
                                            <option v-for="role in roles" :value="role.id">{{ role.name }}</option>
                                        </SelectInput>

                                        <InputError class="mt-2" :message="form.errors.role_id" />
                                    </div>

                                    <div>
                                        <InputLabel for="facilitator_id" value="Facilitator" />

                                        <SelectInput id="facilitator_id" class="mt-1 block w-full"
                                            v-model="form.facilitator_id" :disabled="user.deleted_at">
                                            <option v-for="facilitator in facilitators" :value="facilitator.id">{{
                                                facilitator.name
                                            }}</option>
                                        </SelectInput>

                                        <InputError class="mt-2" :message="form.errors.facilitator_id" />
                                    </div>

                                    <div class="flex items-center gap-4">
                                        <PrimaryButton v-if="!user.deleted_at" :disabled="form.processing">Update
                                        </PrimaryButton>
                                        <SecondaryButton v-if="!user.deleted_at" @click="openModal">Insert Points
                                        </SecondaryButton>
                                        <SecondaryButton @click="reset">
                                            Reset Password
                                        </SecondaryButton>
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
                            <span class="font-semibold text-lg my-2">User Awards</span>
                        </template>
                        <template v-slot:content>
                            <header>
                                <p class="mt-1 text-sm text-gray-600">
                                    View user awards.
                                </p>
                            </header>
                            <div class="flex flex-col">
                                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                                    <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                                        <div class="overflow-hidden">
                                            <table class="min-w-full">
                                                <thead class="bg-white border-b border-t">
                                                    <tr>
                                                        <th scope="col"
                                                            class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                            Name
                                                        </th>
                                                        <th scope="col"
                                                            class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                            Points
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="award in user.awards"
                                                        class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
                                                        <td class="text-sm text-gray-900 font-light px-6 py-4">
                                                            {{ award.name }}
                                                        </td>
                                                        <td class="text-sm text-gray-900 font-light px-6 py-4">
                                                            {{ award.points }}
                                                        </td>
                                                    </tr>
                                                    <tr v-if="user.awards.length === 0">
                                                        <td class="px-6 py-4 border-t text-center" colspan="2">
                                                            No awards found.
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                                <li v-for="history in user.histories">
                                    <div class="flex flex-start items-center">
                                        <div
                                            class="bg-blue-600 w-4 h-4 flex items-center justify-center rounded-full -ml-2 mr-3 -mt-2">
                                        </div>
                                        <h4 class="text-gray-800 font-semibold text-md -mt-2">{{ history.points }}</h4>
                                    </div>
                                    <div class="ml-6 mb-1">
                                        <Link v-if="history.link" :href="history.link"
                                            class="underline text-blue-600 hover:text-blue-700 focus:text-blue-800 duration-300 transition ease-in-out text-sm">
                                        {{ formatDate(history.created_at) }}
                                        </Link>
                                        <span v-if="!history.link"
                                            class="text-blue-600 hover:text-blue-700 focus:text-blue-800 duration-300 transition ease-in-out text-sm">
                                            {{ formatDate(history.created_at) }}
                                        </span>
                                        <p class="text-gray-700 mt-2 mb-4">{{ history.remark }}</p>
                                    </div>
                                </li>
                            </ol>
                        </template>
                    </Accordion>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>

    <Modal :show="showModal" @close="closeModal">
        <div class="p-6">
            <h2 class="text-lg text-center font-medium text-gray-900 mb-2">
                Update Points
            </h2>

            <div class="flex justify-center" id="qr-code">
                <form class="mt-6 space-y-6">
                    <div>
                        <InputLabel for="points" value='Points' />

                        <TextInput id="points" type="number" class="mt-1 block w-full" v-model="pointsForm.points"
                            required autocomplete="points" />

                        <InputError class="mt-2" :message="pointsForm.errors.points" />
                    </div>

                    <div class="flex items-center gap-4">
                        <PrimaryButton v-if="!user.deleted_at" :disabled="pointsForm.processing" @click="insertPoints">
                            Save
                        </PrimaryButton>
                        <SecondaryButton @click="closeModal">
                            Cancel
                        </SecondaryButton>
                    </div>
                </form>
            </div>
        </div>
    </Modal>
</template>

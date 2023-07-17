<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import SelectInput from '@/Components/SelectInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import Accordion from "@/Components/Accordion.vue";
import Modal from '@/Components/Modal.vue';
import { Link, Head } from '@inertiajs/inertia-vue3';
import * as XLSX from 'xlsx';
import axios from 'axios';

export default {
    components: {
        Head,
        Link,
        AuthenticatedLayout,
        PrimaryButton,
        SecondaryButton,
        InputError,
        InputLabel,
        TextInput,
        SelectInput,
        Accordion,
        Modal,
    },
    props: {
        group: Object,
        leaders: Object,
    },
    data() {
        return {
            users: [],
            displayUsers: [],
            status: '',
            code: null,
            buttonDisabled: true,
            showModal: false,
            form: this.$inertia.form({
                leader_id: this.group.leader_id,
                coleader_id: this.group.coleader_id,
                name: this.group.name,
                description: this.group.description,
                remark: this.group.remark,
            }),
            pointsForm: this.$inertia.form({
                points: '',
            }),
        };
    },
    mounted: function () {
        this.loadUsers(this.group.users);
    },
    methods: {
        loadUsers(users) {
            users.sort(this.compare);
            this.displayUsers = users;
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
        getActivation(boolean, date) {
            return boolean ? this.formatDate(date) : 'Not activated'
        },
        upload(event) {
            this.uploadedFile = event.target.files[0];

            const fileReader = new FileReader();
            fileReader.readAsBinaryString(this.uploadedFile);
            fileReader.onload = () => {
                var workbook = XLSX.read(fileReader.result, { type: 'binary' });
                var sheetNames = workbook.SheetNames;
                const excelData = XLSX.utils.sheet_to_json(
                    workbook.Sheets[sheetNames[0]]
                );
                excelData.forEach((user) => {
                    this.users.push(user);
                });
            };
            this.buttonDisabled = false;
        },
        submit() {
            this.buttonDisabled = true;
            axios
                .post(route('groups.upload', this.group), this.users)
                .then((response) => {
                    this.displayUsers = [];
                    response.data.users.sort(this.compare);
                    response.data.users.forEach(user => this.displayUsers.push(user));
                    this.status = response.data.status;
                    this.code = response.status;
                    setTimeout(this.clearCode, 3000);
                }).catch((error) => {
                    this.code = error.response.status;
                    setTimeout(this.clearCode, 3000);
                });
        },
        compare(a, b) {
            if (a.name < b.name) {
                return -1;
            }
            if (a.name > b.name) {
                return 1;
            }
            return 0;
        },
        clearCode() {
            this.code = null;
        },
        showModalForm() {
            this.showModal = true;
        },
        insertPoints() {
            this.pointsForm.put(route("groups.points", this.group), {
                preserveState: true,
            });
            this.showModal = false;
            this.pointsForm.points = '';
        },
        closeModal() {
            this.showModal = false;
        },
    }
}
</script>

<template>

    <Head title="Edit Contingent" />

    <AuthenticatedLayout>

        <div v-if="group.deleted_at"
            class="bg-yellow-100 rounded-b-lg py-5 px-6 mb-3 text-base text-yellow-700 inline-flex items-center w-full"
            role="alert">
            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="exclamation-triangle"
                class="w-4 h-4 mr-2 fill-current" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                <path fill="currentColor"
                    d="M569.517 440.013C587.975 472.007 564.806 512 527.94 512H48.054c-36.937 0-59.999-40.055-41.577-71.987L246.423 23.985c18.467-32.009 64.72-31.951 83.154 0l239.94 416.028zM288 354c-25.405 0-46 20.595-46 46s20.595 46 46 46 46-20.595 46-46-20.595-46-46-46zm-43.673-165.346l7.418 136c.347 6.364 5.609 11.346 11.982 11.346h48.546c6.373 0 11.635-4.982 11.982-11.346l7.418-136c.375-6.874-5.098-12.654-11.982-12.654h-63.383c-6.884 0-12.356 5.78-11.981 12.654z">
                </path>
            </svg>
            This contingent has been deleted from the system, all records are for viewing only
        </div>

        <div class="pt-8 pb-2">
            <div class="mt-4 md:mt-0 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <Accordion>
                        <template v-slot:title>
                            <span class="font-semibold text-lg my-2">Edit Contingent</span>
                        </template>
                        <template v-slot:content>
                            <section>
                                <header>
                                    <div class="flex justify-between">
                                        <span>
                                            <p class="mt-1 text-sm text-gray-600">
                                                View or edit contingents for the event.
                                            </p>
                                        </span>
                                        <span v-if="group.deleted_at" class="mt-1 text-gray-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="45"
                                                height="45" fill="currentColor">
                                                <path
                                                    d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z" />
                                            </svg>
                                        </span>
                                    </div>
                                </header>

                                <form @submit.prevent="form.patch(route('groups.update', group))"
                                    class="mt-6 space-y-6">
                                    <div>
                                        <InputLabel for="name" value="Name" />

                                        <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name"
                                            required :readonly="group.deleted_at" autofocus autocomplete="name" />

                                        <InputError class="mt-2" :message="form.errors.name" />
                                    </div>

                                    <div>
                                        <InputLabel for="leader_id" value="Leader" />

                                        <SelectInput id="leader_id" class="mt-1 block w-full" v-model="form.leader_id"
                                            :disabled="group.deleted_at">
                                            <option v-for="user in leaders" :value="user.id">{{
                                                user.name
                                            }} - {{ user.phone }}</option>
                                        </SelectInput>

                                        <InputError class="mt-2" :message="form.errors.leader_id" />
                                    </div>

                                    <div>
                                        <InputLabel for="coleader_id" value="Co Leader" />

                                        <SelectInput id="coleader_id" class="mt-1 block w-full"
                                            v-model="form.coleader_id" :disabled="group.deleted_at">
                                            <option v-for="user in leaders" :value="user.id">{{
                                                user.name
                                            }} - {{ user.phone }}</option>
                                        </SelectInput>

                                        <InputError class="mt-2" :message="form.errors.coleader_id" />
                                    </div>

                                    <div>
                                        <InputLabel for="description" value="Description" />

                                        <TextInput id="description" type="text" class="mt-1 block w-full"
                                            v-model="form.description" autocomplete="description"
                                            :readonly="group.deleted_at" />

                                        <InputError class="mt-2" :message="form.errors.description" />
                                    </div>

                                    <div>
                                        <InputLabel for="remark" value="Remark" />

                                        <TextInput id="remark" type="text" class="mt-1 block w-full"
                                            v-model="form.remark" :readonly="group.deleted_at" autocomplete="remark" />

                                        <InputError class="mt-2" :message="form.errors.remark" />
                                    </div>

                                    <div class="flex items-center gap-4">
                                        <PrimaryButton v-if="!group.deleted_at" :disabled="form.processing">Update
                                        </PrimaryButton>
                                        <SecondaryButton v-if="!group.deleted_at" @click="showModalForm">Insert Points
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
                            <span class="font-semibold text-lg my-2">Users List</span>
                        </template>
                        <template v-slot:content>
                            <div v-if="code === 200"
                                class="bg-green-100 rounded-lg py-5 px-6 mb-3 text-base text-green-700 inline-flex items-center w-full"
                                role="alert">
                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check-circle"
                                    class="w-4 h-4 mr-2 fill-current" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 512 512">
                                    <path fill="currentColor"
                                        d="M504 256c0 136.967-111.033 248-248 248S8 392.967 8 256 119.033 8 256 8s248 111.033 248 248zM227.314 387.314l184-184c6.248-6.248 6.248-16.379 0-22.627l-22.627-22.627c-6.248-6.249-16.379-6.249-22.628 0L216 308.118l-70.059-70.059c-6.248-6.248-16.379-6.248-22.628 0l-22.627 22.627c-6.248 6.248-6.248 16.379 0 22.627l104 104c6.249 6.249 16.379 6.249 22.628.001z">
                                    </path>
                                </svg>
                                {{ status }}
                            </div>
                            <div v-if="code !== null && code !== 200"
                                class="bg-red-100 rounded-lg py-5 px-6 mb-3 text-base text-red-700 inline-flex items-center w-full"
                                role="alert">
                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="times-circle"
                                    class="w-4 h-4 mr-2 fill-current" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 512 512">
                                    <path fill="currentColor"
                                        d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm121.6 313.1c4.7 4.7 4.7 12.3 0 17L338 377.6c-4.7 4.7-12.3 4.7-17 0L256 312l-65.1 65.6c-4.7 4.7-12.3 4.7-17 0L134.4 338c-4.7-4.7-4.7-12.3 0-17l65.6-65-65.6-65.1c-4.7-4.7-4.7-12.3 0-17l39.6-39.6c4.7-4.7 12.3-4.7 17 0l65 65.7 65.1-65.6c4.7-4.7 12.3-4.7 17 0l39.6 39.6c4.7 4.7 4.7 12.3 0 17L312 256l65.6 65.1z">
                                    </path>
                                </svg>
                                Oops, something went wrong. Please try again
                            </div>
                            <header>
                                <div class="flex justify-between">
                                    <span>
                                        <p class="mt-1 text-sm text-gray-600">
                                            View users in the contingent.
                                        </p>
                                    </span>
                                    <div class="flex justify-center">
                                        <div class="text-center mb-3 w-96">
                                            <label class="form-label inline-block text-xs text-gray-700">
                                                Upload users to contingent
                                            </label>
                                            <input
                                                class="form-control
                                                                    block
                                                                    w-full
                                                                    px-2
                                                                    py-1
                                                                    text-sm
                                                                    font-normal
                                                                    text-gray-700
                                                                    bg-white bg-clip-padding
                                                                    border border-solid border-gray-300
                                                                    rounded
                                                                    transition
                                                                    ease-in-out
                                                                    m-0
                                                                    focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                                @change="upload($event)" type="file">
                                        </div>
                                    </div>
                                    <PrimaryButton class="my-2" @click="submit" :disabled="buttonDisabled"
                                        :class="buttonDisabled ? 'bg-blue-400 hover:bg-blue-400 focus:bg-blue-400' : ''">
                                        Upload
                                    </PrimaryButton>
                                </div>

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
                                                            Staff ID
                                                        </th>
                                                        <th scope="col"
                                                            class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                            Phone
                                                        </th>
                                                        <th scope="col"
                                                            class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                            Activation
                                                        </th>
                                                        <th scope="col"
                                                            class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                            Points
                                                        </th>
                                                        <th scope="col"
                                                            class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                            Action
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="user in displayUsers"
                                                        class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
                                                        <td class="text-sm text-gray-900 font-light px-6 py-4">
                                                            {{ user.name }}
                                                        </td>
                                                        <td class="text-sm text-gray-900 font-light px-6 py-4">
                                                            {{ user.staff_id }}
                                                        </td>
                                                        <td class="text-sm text-gray-900 font-light px-6 py-4">
                                                            {{ user.phone }}
                                                        </td>
                                                        <td class="text-sm text-gray-900 font-light px-6 py-4">
                                                            {{ getActivation(user.is_active, user.activated_at) }}
                                                        </td>
                                                        <td class="text-sm text-gray-900 font-light px-6 py-4">
                                                            {{ user.points }}
                                                        </td>
                                                        <td class="text-sm text-gray-900 font-light px-6 py-4">
                                                            <SecondaryButton class="mx-1">
                                                                <Link :href="route('users.edit', user)">View</Link>
                                                            </SecondaryButton>
                                                        </td>
                                                    </tr>
                                                    <tr v-if="displayUsers.length === 0">
                                                        <td class="px-6 py-4 border-t text-center" colspan="6">
                                                            No users found.
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
                            <span class="font-semibold text-lg my-2">Session Scores</span>
                        </template>
                        <template v-slot:content>
                            <header>
                                <p class="mt-1 text-sm text-gray-600">
                                    View contingent session scores.
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
                                                            Session
                                                        </th>
                                                        <th scope="col"
                                                            class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                            Points
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="score in group.scores"
                                                        class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
                                                        <td class="text-sm text-gray-900 font-light px-6 py-4">
                                                            {{ score.meeting.name }}
                                                        </td>
                                                        <td class="text-sm text-gray-900 font-light px-6 py-4">
                                                            {{ score.points }}
                                                        </td>
                                                    </tr>
                                                    <tr v-if="group.scores.length === 0">
                                                        <td class="px-6 py-4 border-t text-center" colspan="2">
                                                            No scores found.
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
                            <span class="font-semibold text-lg my-2">Contingent Awards</span>
                        </template>
                        <template v-slot:content>
                            <header>
                                <p class="mt-1 text-sm text-gray-600">
                                    View contingent awards.
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
                                                    <tr v-for="award in group.awards"
                                                        class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
                                                        <td class="text-sm text-gray-900 font-light px-6 py-4">
                                                            {{ award.name }}
                                                        </td>
                                                        <td class="text-sm text-gray-900 font-light px-6 py-4">
                                                            {{ award.points }}
                                                        </td>
                                                    </tr>
                                                    <tr v-if="group.awards.length === 0">
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
                                <li v-for="history in group.histories">
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
                <form @submit.prevent="insertPoints" class="mt-6 space-y-6">
                    <div>
                        <InputLabel for="points" value='Points' />

                        <TextInput id="points" type="number" class="mt-1 block w-full" v-model="pointsForm.points"
                            required :readonly="group.deleted_at" autofocus autocomplete="points" />

                        <InputError class="mt-2" :message="pointsForm.errors.points" />
                    </div>

                    <div class="flex items-center gap-4">
                        <PrimaryButton v-if="!group.deleted_at" :disabled="pointsForm.processing">Save
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

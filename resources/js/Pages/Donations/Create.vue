<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import FileInput from '@/Components/FileInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import { useForm, Head } from '@inertiajs/inertia-vue3';

function back() {
    window.history.back();
};

// const props = defineProps({
//     leaders: Object,
// });

const form = useForm({
    name: "",
    description: "",
    target: "",
    file_upload: [],
});

function onChange(e) {
    if (e.target.files) {
        console.log(e, e.target.files[0]);
        form.file_upload = e.target.files[0];
    }
}
</script>

<template>

    <Head title="Add Donations" />

    <AuthenticatedLayout>

        <div class="pt-8 pb-2">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">Add Donation</h2>

                            <p class="mt-1 text-sm text-gray-600">
                                Create new donations for the event.
                            </p>
                        </header>

                        <form @submit.prevent="form.post(route('donations.store'))" enctype="multipart/form-data" class="mt-6 space-y-6" @change="onChange">
                            <div>
                                <InputLabel for="name" value="Name" />

                                <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required
                                    autofocus autocomplete="name" />

                                <InputError class="mt-2" :message="form.errors.name" />
                            </div>

                            <div>
                                <InputLabel for="description" value="Description" />

                                <TextInput id="description" type="text" class="mt-1 block w-full"
                                    v-model="form.description" autocomplete="description" />

                                <InputError class="mt-2" :message="form.errors.description" />
                            </div>

                            <div>
                                <InputLabel for="target" value="Target" />

                                <TextInput id="target" type="number" step=".01" class="mt-1 block w-full" v-model="form.target"
                                    autocomplete="target" />

                                <InputError class="mt-2" :message="form.errors.target" />
                            </div>

                            <div>
                                <InputLabel for="uploadPic" value="Upload Picture for donation" />

                                <!-- <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="file_input" type="file"> -->
                                <FileInput id="file_upload" type="file" class="mt-1 block w-full" />
                                <!-- <input type="file" name="file_upload" id="file_upload"/> -->

                                <InputError class="mt-2" :message="form.errors.file_upload" />
                            </div>

                            <div class="flex items-center gap-4">
                                <PrimaryButton :disabled="form.processing">Create</PrimaryButton>
                                <SecondaryButton @click="back">
                                    Cancel
                                </SecondaryButton>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

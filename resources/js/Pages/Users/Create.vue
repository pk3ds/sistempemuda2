<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import SelectInput from '@/Components/SelectInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import { useForm, Head } from '@inertiajs/inertia-vue3';

function back() {
    window.history.back();
};

const form = useForm({
    name: "",
    username: "",
    email: "",
    phone: "",
    no_ahli: "",
    alamat: ""
});
</script>

<template>

    <Head title="Add User" />

    <AuthenticatedLayout>

        <div class="pt-8 pb-2">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">Add User</h2>

                            <p class="mt-1 text-sm text-gray-600">
                                Create new users for the event.
                            </p>
                        </header>

                        <form @submit.prevent="form.post(route('users.store'))" class="mt-6 space-y-6">
                            <div>
                                <InputLabel for="name" value="Name" />

                                <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required
                                    autofocus autocomplete="name" />

                                <InputError class="mt-2" :message="form.errors.name" />
                            </div>

                            <div>
                                <InputLabel for="username" value="Username" />

                                <TextInput id="username" type="text" class="mt-1 block w-full" v-model="form.username"
                                    autocomplete="username" />

                                <InputError class="mt-2" :message="form.errors.username" />
                            </div>

                            <div>
                                <InputLabel for="email" value="Email" />

                                <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email"
                                    autocomplete="email" />

                                <InputError class="mt-2" :message="form.errors.email" />
                            </div>

                            <div>
                                <InputLabel for="phone" value="Phone" />

                                <TextInput id="phone" type="text" class="mt-1 block w-full" v-model="form.phone"
                                    required autocomplete="phone" />

                                <InputError class="mt-2" :message="form.errors.phone" />
                            </div>

                            <div>
                                <InputLabel for="no_ahli" value="No Ahli PAS" />

                                <TextInput id="no_ahli" type="text" class="mt-1 block w-full" v-model="form.no_ahli"
                                    autocomplete="no_ahli" />

                                <InputError class="mt-2" :message="form.errors.no_ahli" />
                            </div>

                            <div>
                                <InputLabel for="alamat" value="Alamat" />

                                <TextInput id="alamat" type="text" class="mt-1 block w-full" v-model="form.alamat"
                                    autocomplete="alamat" />

                                <InputError class="mt-2" :message="form.errors.alamat" />
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

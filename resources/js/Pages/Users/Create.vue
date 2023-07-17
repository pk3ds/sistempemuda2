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

const props = defineProps({
    facilitators: Object,
});

const form = useForm({
    name: "",
    staff_id: "",
    email: "",
    phone: "",
    division: "",
    facilitator_id: "",
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
                                <InputLabel for="staff_id" value="Staff ID" />

                                <TextInput id="staff_id" type="text" class="mt-1 block w-full" v-model="form.staff_id"
                                    autocomplete="staff_id" />

                                <InputError class="mt-2" :message="form.errors.staff_id" />
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
                                <InputLabel for="division" value="Division" />

                                <TextInput id="division" type="text" class="mt-1 block w-full" v-model="form.division"
                                    autocomplete="division" />

                                <InputError class="mt-2" :message="form.errors.division" />
                            </div>

                            <div>
                                <InputLabel for="facilitator_id" value="Facilitator" />

                                <SelectInput id="facilitator_id" class="mt-1 block w-full"
                                    v-model="form.facilitator_id">
                                    <option v-for="facilitator in facilitators" :value="facilitator.id">{{
                                        facilitator.name
                                    }}</option>
                                </SelectInput>

                                <InputError class="mt-2" :message="form.errors.facilitator_id" />
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

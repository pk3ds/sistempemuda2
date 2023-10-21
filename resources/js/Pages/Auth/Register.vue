<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import SelectInput from '@/Components/SelectInput.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';

const form = useForm({
    staff_id: '',
    name: '',
    email: '',
    password: 'password',
    password_confirmation: 'password',
    phone: '',
    division: '',
    terms: false,
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <GuestLayout>

        <Head title="Register" />

        <form @submit.prevent="submit">

            <div class="mt-4">
                <InputLabel for="name" value="Nama" />

                <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required
                    autocomplete="name" />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div class="mt-4">
                <InputLabel for="phone" value="Phone" />

                <TextInput id="phone" type="text" class="mt-1 block w-full" v-model="form.phone" required
                    autocomplete="phone" />

                <InputError class="mt-2" :message="form.errors.phone" />
            </div>

            <div class="mt-4">
                <InputLabel for="entiti" value="Entiti" />
                <SelectInput id="division" class="mt-1 block w-full" v-model="form.division">
                    <!-- inline object literal -->
                    <option :value="empty">Sila Pilih</option>
                    <option :value="JEMPUTAN">JEMPUTAN</option>
                    <option :value="PASTI">PASTI</option>
                    <option :value="SRITI">SRITI</option>
                </SelectInput>

            </div>

            <div class="flex items-center justify-end mt-4">

                <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Register
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>

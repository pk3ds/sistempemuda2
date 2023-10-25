<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import SelectInput from '@/Components/SelectInput.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';

const form = useForm({
    username: '',
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    phone: '',
    ic_number: '',
    alamat: '',
    terms: false,
});

const submit = () => {
    form.phone = form.phone.replace(/[^0-9 ]/g, '');
    if (form.phone.substring(0,1) !== '6') {
        form.phone = '6' + form.phone;
    }
    form.ic_number = form.ic_number.replace(/[^0-9 ]/g, '');
    const nameStr = form.name.split(" ");
    form.name = nameStr.map((names) => {
        return names[0].toUpperCase() + names.substring(1).toLowerCase();
    }).join(" ");
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
                <InputLabel for="username" value="Username" />

                <TextInput id="username" type="text" class="mt-1 block w-full" v-model="form.username" required
                    autocomplete="username" />

                <InputError class="mt-2" :message="form.errors.username" />
            </div>

            <div class="mt-4">
                <InputLabel for="name" value="Nama" />

                <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required
                    autocomplete="name" />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div class="mt-4">
                <InputLabel for="email" value="Email" />

                <TextInput id="email" type="text" class="mt-1 block w-full" v-model="form.email" required
                    autocomplete="email" password />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Password" />

                <TextInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" required
                    autocomplete="password" password />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4">
                <InputLabel for="password_confirmation" value="Password Confirmation" />

                <TextInput id="password_confirmation" type="password" class="mt-1 block w-full" v-model="form.password_confirmation" required
                    autocomplete="password_confirmation" />

                <InputError class="mt-2" :message="form.errors.password_confirmation" />
            </div>

            <div class="mt-4">
                <InputLabel for="phone" value="Phone" />

                <TextInput id="phone" type="text" class="mt-1 block w-full" v-model="form.phone" required
                    autocomplete="phone" />

                <InputError class="mt-2" :message="form.errors.phone" />
            </div>

            <div class="mt-4">
                <InputLabel for="ic_number" value="No K/P" />

                <TextInput id="ic_number" type="text" class="mt-1 block w-full" v-model="form.ic_number"
                    autocomplete="ic_number" />

                <InputError class="mt-2" :message="form.errors.ic_number" />
            </div>

            <div class="mt-4">
                <InputLabel for="alamat" value="Alamat" />

                <TextInput id="alamat" type="text" class="mt-1 block w-full" v-model="form.alamat"
                    autocomplete="alamat" />

                <InputError class="mt-2" :message="form.errors.alamat" />
            </div>

            <div class="flex items-center justify-end mt-4">

                <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Register
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>

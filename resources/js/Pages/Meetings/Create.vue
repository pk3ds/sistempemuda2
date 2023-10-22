<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import { useForm, Head } from '@inertiajs/inertia-vue3';
import Datepicker from '@vuepic/vue-datepicker';
import Checkbox from '@/Components/Checkbox.vue';
import '@vuepic/vue-datepicker/dist/main.css';

function back() {
    window.history.back();
};

const form = useForm({
    name: "",
    description: "",
    start_at: "",
    end_at: "",
    ahli: false,
});
</script>

<template>

    <Head title="Add Session" />

    <AuthenticatedLayout>

        <div class="pt-8 pb-2">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">Add Session</h2>

                            <p class="mt-1 text-sm text-gray-600">
                                Create new sessions for the event.
                            </p>
                        </header>

                        <form @submit.prevent="form.post(route('sessions.store'))" class="mt-6 space-y-6">
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

                            <!-- FIXME use range for future version -->
                            <div>
                                <InputLabel for="start_at" value="Start" />

                                <Datepicker v-model="form.start_at" :format="'dd MMM yyyy, HH:mm'" required>
                                </Datepicker>

                                <InputError class="mt-2" :message="form.errors.start_at" />
                            </div>

                            <div>
                                <InputLabel for="end_at" value="End" />

                                <Datepicker v-model="form.end_at" :format="'dd MMM yyyy, HH:mm'" required></Datepicker>

                                <InputError class="mt-2" :message="form.errors.end_at" />
                            </div>

                            <div class="block mt-4">
                                <label class="flex items-center">
                                    <Checkbox name="ahli" v-model:checked="form.ahli" />
                                    <span class="ml-2 text-sm text-gray-600">ahli?</span>
                                </label>
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

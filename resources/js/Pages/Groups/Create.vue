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
    leaders: Object,
});

const form = useForm({
    leader_id: "",
    coleader_id: "",
    name: "",
    description: "",
    remark: "",
});
</script>

<template>

    <Head title="Add Contingent" />

    <AuthenticatedLayout>

        <div class="pt-8 pb-2">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">Add Contingent</h2>

                            <p class="mt-1 text-sm text-gray-600">
                                Create new contingents for the event.
                            </p>
                        </header>

                        <form @submit.prevent="form.post(route('groups.store'))" class="mt-6 space-y-6">
                            <div>
                                <InputLabel for="name" value="Name" />

                                <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required
                                    autofocus autocomplete="name" />

                                <InputError class="mt-2" :message="form.errors.name" />
                            </div>

                            <div>
                                <InputLabel for="leader_id" value="Leader" />

                                <SelectInput id="leader_id" class="mt-1 block w-full" v-model="form.leader_id" required>
                                    <option v-for="user in leaders" :value="user.id">{{
                                        user.name
                                    }} - {{ user.phone }}</option>
                                </SelectInput>

                                <InputError class="mt-2" :message="form.errors.leader_id" />
                            </div>

                            <div>
                                <InputLabel for="coleader_id" value="Co Leader" />

                                <SelectInput id="coleader_id" class="mt-1 block w-full" v-model="form.coleader_id"
                                    required>
                                    <option v-for="user in leaders" :value="user.id">{{
                                        user.name
                                    }} - {{ user.phone }}</option>
                                </SelectInput>

                                <InputError class="mt-2" :message="form.errors.coleader_id" />
                            </div>

                            <div>
                                <InputLabel for="description" value="Description" />

                                <TextInput id="description" type="text" class="mt-1 block w-full"
                                    v-model="form.description" autocomplete="description" />

                                <InputError class="mt-2" :message="form.errors.description" />
                            </div>

                            <div>
                                <InputLabel for="remark" value="Remark" />

                                <TextInput id="remark" type="text" class="mt-1 block w-full" v-model="form.remark"
                                    autocomplete="remark" />

                                <InputError class="mt-2" :message="form.errors.remark" />
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

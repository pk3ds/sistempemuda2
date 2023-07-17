<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import SelectInput from '@/Components/SelectInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
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
        Head
    },
    props: {
        meetings: Object,
        groups: Object,
        users: Object,
    },
    remember: "form",
    data() {
        return {
            recipients: [],
            form: this.$inertia.form({
                meeting_id: "",
                name: "",
                remark: "",
                points: "",
                recipient_type: "",
                recipient_id: "",
            }),
        };
    },
    mounted() {
        this.loadRecipients(this.form.recipient_type);
    },
    methods: {
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
    },
};
</script>

<template>

    <Head title="Add Award" />

    <AuthenticatedLayout>

        <div class="pt-8 pb-2">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">Add Award</h2>

                            <p class="mt-1 text-sm text-gray-600">
                                Create new awards for the group or user.
                            </p>
                        </header>

                        <form @submit.prevent="form.post(route('awards.store'))" class="mt-6 space-y-6">
                            <div>
                                <InputLabel for="name" value="Name" />

                                <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required
                                    autofocus autocomplete="name" />

                                <InputError class="mt-2" :message="form.errors.name" />
                            </div>

                            <div>
                                <InputLabel for="remark" value="Remark" />

                                <TextInput id="remark" type="text" class="mt-1 block w-full" v-model="form.remark"
                                    autocomplete="remark" />

                                <InputError class="mt-2" :message="form.errors.remark" />
                            </div>

                            <div>
                                <InputLabel for="points" value="Points" />

                                <TextInput id="points" type="number" class="mt-1 block w-full" v-model="form.points"
                                    required autocomplete="points" />

                                <InputError class="mt-2" :message="form.errors.points" />
                            </div>

                            <div>
                                <InputLabel for="meeting_id" value="Session" />

                                <SelectInput id="meeting_id" class="mt-1 block w-full" v-model="form.meeting_id">
                                    <option v-for="meeting in meetings" :value="meeting.id">{{ meeting.name }}
                                    </option>
                                </SelectInput>

                                <InputError class="mt-2" :message="form.errors.meeting_id" />
                            </div>

                            <div>
                                <InputLabel for="recipient_type" value="Recipient Type" />

                                <SelectInput id="recipient_type" class="mt-1 block w-full" v-model="form.recipient_type"
                                    @change="loadRecipients(form.recipient_type)">
                                    <option value="AppModelsGroup">Contingent</option>
                                    <option value="AppModelsUser">User</option>
                                </SelectInput>

                                <InputError class="mt-2" :message="form.errors.recipient_type" />
                            </div>

                            <div v-if="recipients.length !== 0">
                                <InputLabel for="recipient_id" value="Recipient" />

                                <SelectInput id="recipient_id" class="mt-1 block w-full" v-model="form.recipient_id">
                                    <option v-for="recipient in recipients" :value="recipient.id">{{ recipient.name }}
                                    </option>
                                </SelectInput>

                                <InputError class="mt-2" :message="form.errors.recipient_id" />
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

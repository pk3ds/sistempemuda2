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
        Head,
        Link,
        AuthenticatedLayout,
        PrimaryButton,
        SecondaryButton,
        InputError,
        InputLabel,
        TextInput,
        SelectInput,
    },
    props: {
        winner: Object,
    },
    data() {
        return {
            form: this.$inertia.form({
                name: this.winner.user.name,
                prize: this.winner.prize,
                remark: this.winner.remark,
                is_claimed: this.winner.is_claimed,
            }),
        };
    },
    methods: {
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
        // TODO add confirm for claim prize button
    }
}
</script>

<template>

    <Head title="Edit Winner" />

    <AuthenticatedLayout>

        <div class="pt-8 pb-2">
            <div class="mt-4 md:mt-0 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <section>
                        <header>
                            <div class="flex justify-between">
                                <span>
                                    <p class="mt-1 text-sm text-gray-600">
                                        View or edit winners for lucky draw.
                                    </p>
                                </span>
                            </div>
                        </header>

                        <form @submit.prevent="form.patch(route('winners.update', winner.id))" class="mt-6 space-y-6">
                            <div>
                                <InputLabel for="name" value="Name" />

                                <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required
                                    readonly autocomplete="name" />

                                <InputError class="mt-2" :message="form.errors.name" />
                            </div>

                            <div>
                                <InputLabel for="prize" value="Prize" />

                                <TextInput id="prize" type="text" class="mt-1 block w-full" v-model="form.prize"
                                    autocomplete="prize" :readonly="winner.is_claimed" />

                                <InputError class="mt-2" :message="form.errors.prize" />
                            </div>

                            <div>
                                <InputLabel for="remark" value="Remark" />

                                <TextInput id="remark" type="text" class="mt-1 block w-full" v-model="form.remark"
                                    :readonly="winner.is_claimed" autocomplete="remark" />

                                <InputError class="mt-2" :message="form.errors.remark" />
                            </div>

                            <div>
                                <InputLabel for="is_claimed" value="Status" />

                                <SelectInput id="is_claimed" class="mt-1 block w-full" v-model="form.is_claimed"
                                    :disabled="winner.is_claimed" required>
                                    <option :value="1">Claimed</option>
                                    <option :value="0">Not claimed</option>
                                </SelectInput>

                                <InputError class="mt-2" :message="form.errors.is_claimed" />
                            </div>

                            <div class="flex items-center gap-4">
                                <PrimaryButton :disabled="form.processing">Update
                                </PrimaryButton>
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

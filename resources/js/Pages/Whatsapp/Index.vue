<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import SelectInput from '@/Components/SelectInput.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import { useForm, Head } from '@inertiajs/inertia-vue3';
import '@vuepic/vue-datepicker/dist/main.css';
import TextArea from '../../Components/TextArea.vue';
import FileInput from '@/Components/FileInput.vue';

const props = defineProps({
    whatsappNumber: Object,
});

function back() {
    window.history.back();
};

function onChange(e) {
    if (e.target.files) {
        form.file_upload = e.target.files[0];
    }
};

function testLog() {
    console.log(props.whatsappNumber);
}

const form = useForm({
    message: "",
    option: "",
    file_upload: [],
    caption: "",
    view_once: false,
    compress: true,
    number: "",
});
</script>

<template>

    <Head title="Whatsapp Blasting" />

    <AuthenticatedLayout :auth="$page.props.auth">
        <div class="pt-8 pb-2">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">Whatsapp Blasting</h2>

                            <p class="mt-1 text-sm text-gray-600">
                                Send whatsapp
                            </p>
                        </header>

                        <form @submit.prevent="form.post(route('whatsapp.store'))" enctype="multipart/form-data" class="mt-6 space-y-6" @change="onChange">
                            <div>
                                <InputLabel for="number" value="Blasting Number" />

                                <SelectInput id="number" class="mt-1 block w-full" v-model="form.number" required>
                                    <option v-for="number in props.whatsappNumber" :disabled="number.first_whatsapp_batches?.isActive">
                                        {{ number.name }} <span v-if="number.first_whatsapp_batches?.isActive"> - number blasting in progress</span>
                                    </option>
                                </SelectInput>

                                <InputError class="mt-2" :message="form.errors.name" />
                            </div>
                            
                            <div>
                                <InputLabel for="option" value="Blasting Option" />

                                <!-- <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" 
                                    autofocus /> -->

                                <SelectInput id="option" class="mt-1 block w-full" v-model="form.option" required>
                                    <option value="message">Message</option>
                                    <option value="photo">Photo</option>
                                    <!-- <option value="video">Video</option> -->
                                </SelectInput>

                                <InputError class="mt-2" :message="form.errors.name" />
                            </div>

                            <div v-if="form.option === 'message'">
                                <InputLabel for="message" value="Message" />

                                <TextArea id="message" type="text" class="mt-1 block w-full"
                                    v-model="form.message" required />

                                <InputError class="mt-2" :message="form.errors.message" />
                            </div>

                            <div v-if="['photo', 'video'].indexOf(form.option) > -1">
                                <div>
                                    <InputLabel for="message" value="Message" />
    
                                    <TextArea id="message" type="text" class="mt-1 block w-full"
                                        v-model="form.message" required />
    
                                    <InputError class="mt-2" :message="form.errors.message" />
                                </div>
                                
                                <div v-if="form.option === 'photo'" class="pt-5">
                                    <InputLabel for="file_upload" value="Image" />
    
                                    <FileInput id="file_upload" type="file" class="mt-1 block w-full" accept="image/*" />
    
                                    <InputError class="mt-2" :file_upload="form.errors.file_upload" />
                                </div>

                                <div v-if="form.option === 'video'" class="pt-5">
                                    <InputLabel for="file_upload" value="Video" />
    
                                    <TextInput id="file_upload" type="file" class="mt-1 block w-full"
                                        v-model="form.file_upload" accept="video/*" />
    
                                    <InputError class="mt-2" :file_upload="form.errors.file_upload" />
                                </div>
                            </div>

                            <div class="flex items-center gap-4">
                                <PrimaryButton :disabled="form.processing">Send</PrimaryButton>
                                <SecondaryButton @click="back">
                                    Cancel
                                </SecondaryButton>
                                <button @click="testLog()">
                                    test
                                </button>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
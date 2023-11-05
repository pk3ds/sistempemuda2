<script setup>
import { ref } from 'vue';
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

const options = ref([
    { text: 'In Stock', value: 'inStock' },
    { text: 'Out of Stock', value: 'outOfStock' }
])

const form = useForm({
    name: "",
    price: "",
    description: "",
    image: "",
    stock_status: ref("inStock"),
    total_stock: "",
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
                            <h2 class="text-lg font-medium text-gray-900">Add Product</h2>

                            <p class="mt-1 text-sm text-gray-600">
                                Create new product to sell.
                            </p>
                        </header>

                        <form @submit.prevent="form.post(route('products.store'))" class="mt-6 space-y-6">
                            <div>
                                <InputLabel for="name" value="Product Name" />

                                <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required
                                    autofocus />

                                <InputError class="mt-2" :message="form.errors.name" />
                            </div>

                            <div>
                                <InputLabel for="price" value="Product Price" />

                                <TextInput id="price" type="text" class="mt-1 block w-full" v-model="form.price"
                                    required />

                                <InputError class="mt-2" :message="form.errors.price" />
                            </div>

                            <div>
                                <InputLabel for="description" value="Description" />

                                <TextInput id="description" type="text" class="mt-1 block w-full" v-model="form.description" />

                                <InputError class="mt-2" :message="form.errors.description" />
                            </div>

                            <div>
                                <InputLabel for="image" value="Image" />

                                <TextInput id="image" type="text" class="mt-1 block w-full" v-model="form.image" />

                                <InputError class="mt-2" :message="form.errors.image" />
                            </div>

                            <div>
                                <InputLabel for="stock_status" value="Stock Status" />

                                <SelectInput id="stock_status" class="mt-1 block w-full" v-model="form.stock_status" required>
                                    <option v-for="option in options" :value="option.value">
                                        {{ option.text }}
                                    </option>
                                </SelectInput>

                                <InputError class="mt-2" :message="form.errors.stock_status" />
                            </div>

                            <div>
                                <InputLabel for="total_stock" value="Total Stock" />

                                <TextInput id="total_stock" type="text" class="mt-1 block w-full" v-model="form.total_stock" />

                                <InputError class="mt-2" :message="form.errors.total_stock" />
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

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import { useForm, Head } from "@inertiajs/inertia-vue3";

function back() {
  window.history.back();
}

defineProps({
  permissions: {},
});

const form = useForm({
  name: "",
  permission_id: [],
});

function getPermission() {
  console.log(form.permission_id);
}
</script>

<template>
  <Head title="Add User" />

  <AuthenticatedLayout>
    <div class="pt-8 pb-2">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
          <section>
            <header>
              <h2 class="text-lg font-medium text-gray-900">Add Role</h2>

              <p class="mt-1 text-sm text-gray-600">
                Create new roles for the system.
              </p>
            </header>

            <form
              @submit.prevent="form.post(route('roles.store'))"
              class="mt-6 space-y-6"
            >
              <div>
                <InputLabel for="name" value="Name" />

                <TextInput
                  id="name"
                  type="text"
                  class="mt-1 block w-full"
                  v-model="form.name"
                  required
                  autofocus
                  autocomplete="name"
                />

                <InputError class="mt-2" :message="form.errors.name" />
              </div>

              <div>
                <InputLabel for="permission_id" value="Permission" />

                <select
                  id="permission_id"
                  class="border-gray-300 focus:border-emerald-600 focus:ring-emerald-600 rounded-md shadow-sm mt-1 block w-full"
                  v-model="form.permission_id"
                  multiple
                >
                  <option
                    v-for="permission in permissions"
                    :value="permission.name"
                    :key="permission.name"
                  >
                    {{ permission.name }}
                  </option>
                </select>

                <InputError class="mt-2" :message="form.errors.permission_id" />
              </div>

              <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">
                  Create
                </PrimaryButton>
                <SecondaryButton @click="back"> Cancel </SecondaryButton>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

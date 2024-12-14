<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import DangerButton from "@/Components/DangerButton.vue";
import Modal from "@/Components/Modal.vue";
import { useForm, Head, router } from "@inertiajs/inertia-vue3";
import { ref } from "vue";

const props = defineProps({
  whatsappNumbers: Array,
  users: Array,
});

const showingUserModal = ref(false);
const showingEditModal = ref(false);
const selectedNumber = ref(null);

const form = useForm({
  name: "",
  number: "",
  port: "",
  address: "",
  canSendPersonal: false,
  isActive: true,
});

const editForm = useForm({
  name: "",
  number: "",
  port: "",
  address: "",
  canSendPersonal: false,
  isActive: true,
});

const userForm = useForm({
  user_ids: [],
});

function openUserModal(number) {
  selectedNumber.value = number;
  userForm.user_ids = number.users.map((user) => user.id);
  showingUserModal.value = true;
}

function openEditModal(number) {
  selectedNumber.value = number;
  editForm.name = number.name;
  editForm.number = number.number;
  editForm.port = number.port;
  editForm.address = number.address;
  editForm.canSendPersonal = number.canSendPersonal;
  editForm.isActive = number.isActive;
  showingEditModal.value = true;
}

const onSubmit = () => {
  form.post(route("whatsapp.numbers.store"), {
    onSuccess: () => {
      form.reset();
    },
  });
};

const onUserSubmit = () => {
  userForm.put(
    route("whatsapp.numbers.users.update", selectedNumber.value.id),
    {
      onSuccess: () => {
        showingUserModal.value = false;
      },
    }
  );
};

const onEditSubmit = () => {
  editForm.put(route("whatsapp.numbers.update", selectedNumber.value.id), {
    onSuccess: () => {
      showingEditModal.value = false;
    },
  });
};

// Add this with your other form declarations at the top
const deleteForm = useForm({});

// Replace your deleteNumber function with this
function deleteNumber(id) {
  if (confirm("Are you sure you want to delete this number?")) {
    deleteForm.delete(route("whatsapp.numbers.destroy", id), {
      onSuccess: () => {
        // Optional: Add any success handling here
      },
      onError: () => {
        // Optional: Add any error handling here
      },
    });
  }
}
</script>

<template>
  <Head title="Manage WhatsApp Numbers" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Manage WhatsApp Numbers
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <!-- Create New Number Form -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
          <h3 class="text-lg font-medium text-gray-900 mb-4">
            Add New WhatsApp Number
          </h3>

          <form @submit.prevent="onSubmit" class="mt-6 space-y-6">
            <div>
              <InputLabel for="name" value="Name" />
              <TextInput
                id="name"
                type="text"
                class="mt-1 block w-full"
                v-model="form.name"
                required
              />
              <InputError :message="form.errors.name" class="mt-2" />
            </div>

            <div>
              <InputLabel for="number" value="Number" />
              <TextInput
                id="number"
                type="text"
                class="mt-1 block w-full"
                v-model="form.number"
                required
              />
              <InputError :message="form.errors.number" class="mt-2" />
            </div>

            <div>
              <InputLabel for="port" value="Port" />
              <TextInput
                id="port"
                type="text"
                class="mt-1 block w-full"
                v-model="form.port"
                required
              />
              <InputError :message="form.errors.port" class="mt-2" />
            </div>

            <div>
              <InputLabel for="address" value="Address" />
              <TextInput
                id="address"
                type="text"
                class="mt-1 block w-full"
                v-model="form.address"
              />
              <InputError :message="form.errors.address" class="mt-2" />
            </div>

            <div class="flex items-center">
              <input
                type="checkbox"
                id="isActive"
                v-model="form.isActive"
                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
              />
              <InputLabel for="isActive" value="Is Active" class="ml-2" />
            </div>

            <div class="flex items-center">
              <input
                type="checkbox"
                id="canSendPersonal"
                v-model="form.canSendPersonal"
                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
              />
              <InputLabel
                for="canSendPersonal"
                value="Can Send Personal Messages"
                class="ml-2"
              />
            </div>

            <PrimaryButton :disabled="form.processing"
              >Add Number</PrimaryButton
            >
          </form>
        </div>

        <!-- Numbers List -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">
              WhatsApp Numbers
            </h3>

            <div class="overflow-x-auto">
              <table class="min-w-full divide-y divide-gray-200">
                <thead>
                  <tr>
                    <th
                      class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                    >
                      Name
                    </th>
                    <th
                      class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                    >
                      Number
                    </th>
                    <th
                      class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                    >
                      Port
                    </th>
                    <th
                      class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                    >
                      Address
                    </th>
                    <th
                      class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                    >
                      Personal
                    </th>
                    <th
                      class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                    >
                      Status
                    </th>
                    <th
                      class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                    >
                      Actions
                    </th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                  <tr v-for="number in whatsappNumbers" :key="number.id">
                    <td class="px-6 py-4 whitespace-nowrap">
                      {{ number.name }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      {{ number.number }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      {{ number.port }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      {{ number.address }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      {{ number.canSendPersonal ? "Yes" : "No" }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      {{ number.isActive ? "Active" : "Inactive" }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <PrimaryButton
                        class="mr-2"
                        @click="openEditModal(number)"
                      >
                        Edit
                      </PrimaryButton>
                      <PrimaryButton
                        class="mr-2"
                        @click="openUserModal(number)"
                      >
                        Manage Users
                      </PrimaryButton>
                      <DangerButton @click="deleteNumber(number.id)">
                        Delete
                      </DangerButton>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- User Assignment Modal -->
    <Modal :show="showingUserModal" @close="showingUserModal = false">
      <div class="p-6">
        <h2 class="text-lg font-medium text-gray-900 mb-4">
          Manage Users for {{ selectedNumber?.name }}
        </h2>

        <form @submit.prevent="onUserSubmit">
          <div class="max-h-60 overflow-y-auto">
            <div
              v-for="user in users"
              :key="user.id"
              class="flex items-center mb-2 ml-2"
            >
              <input
                type="checkbox"
                :id="'user_' + user.id"
                v-model="userForm.user_ids"
                :value="user.id"
                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
              />
              <label :for="'user_' + user.id" class="ml-2">
                {{ user.name }}
              </label>
            </div>
          </div>

          <div class="mt-4 flex justify-end">
            <SecondaryButton class="mr-2" @click="showingUserModal = false">
              Cancel
            </SecondaryButton>
            <PrimaryButton :disabled="userForm.processing">
              Save
            </PrimaryButton>
          </div>
        </form>
      </div>
    </Modal>

    <!-- Edit Number Modal -->
    <Modal :show="showingEditModal" @close="showingEditModal = false">
      <div class="p-6">
        <h2 class="text-lg font-medium text-gray-900 mb-4">
          Edit WhatsApp Number: {{ selectedNumber?.name }}
        </h2>

        <form @submit.prevent="onEditSubmit" class="space-y-6">
          <div>
            <InputLabel for="edit_name" value="Name" />
            <TextInput
              id="edit_name"
              type="text"
              class="mt-1 block w-full"
              v-model="editForm.name"
              required
            />
            <InputError :message="editForm.errors.name" class="mt-2" />
          </div>

          <div>
            <InputLabel for="edit_number" value="Number" />
            <TextInput
              id="edit_number"
              type="text"
              class="mt-1 block w-full"
              v-model="editForm.number"
              required
            />
            <InputError :message="editForm.errors.number" class="mt-2" />
          </div>

          <div>
            <InputLabel for="edit_port" value="Port" />
            <TextInput
              id="edit_port"
              type="text"
              class="mt-1 block w-full"
              v-model="editForm.port"
              required
            />
            <InputError :message="editForm.errors.port" class="mt-2" />
          </div>

          <div>
            <InputLabel for="edit_address" value="Address" />
            <TextInput
              id="edit_address"
              type="text"
              class="mt-1 block w-full"
              v-model="editForm.address"
            />
            <InputError :message="editForm.errors.address" class="mt-2" />
          </div>

          <div class="flex items-center">
            <input
              type="checkbox"
              id="edit_isActive"
              v-model="editForm.isActive"
              class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
            />
            <InputLabel for="edit_isActive" value="Is Active" class="ml-2" />
          </div>

          <div class="flex items-center">
            <input
              type="checkbox"
              id="edit_canSendPersonal"
              v-model="editForm.canSendPersonal"
              class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
            />
            <InputLabel
              for="edit_canSendPersonal"
              value="Can Send Personal Messages"
              class="ml-2"
            />
          </div>

          <div class="mt-4 flex justify-end">
            <SecondaryButton class="mr-2" @click="showingEditModal = false">
              Cancel
            </SecondaryButton>
            <PrimaryButton :disabled="editForm.processing">
              Save Changes
            </PrimaryButton>
          </div>
        </form>
      </div>
    </Modal>
  </AuthenticatedLayout>
</template>

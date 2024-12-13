<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import SelectInput from "@/Components/SelectInput.vue";
import TextInput from "@/Components/TextInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import { useForm, Head, usePage } from "@inertiajs/inertia-vue3";
import "@vuepic/vue-datepicker/dist/main.css";
import TextArea from "../../Components/TextArea.vue";
import FileInput from "@/Components/FileInput.vue";
import HalfCircleSpinner from "@/Components/Loading.vue";
import { ref, computed } from "vue";
import axios from "axios";

const loading = ref(false);
const response = ref(null);

const { ...data } = computed(() => usePage().props.value.flash).value;

const props = defineProps({
  whatsappNumber: Object,
});

function back() {
  window.history.back();
}

function onChange(e) {
  if (e.target.files) {
    form.file_upload = e.target.files[0];
  }
}

function testLog() {
  console.log(props.whatsappNumber, form.array_number);
}

function assignPort(e) {
  const index = e.target.value;
  form.port = props.whatsappNumber[index - 1].port;
}

function handlePaste(e) {
  e.preventDefault();
  const pastedText = e.clipboardData.getData("text");
  // Keep existing numbers by concatenating with a comma
  const existingNumbers = form.array_number ? form.array_number + "," : "";
  editNumber(existingNumbers + pastedText);
  // Clear the input field after pasting
  if (numberInput.value) {
    numberInput.value.value = "";
  }
}

function handleInputKeydown(e) {
  // Handle Ctrl+A
  if (e.ctrlKey && e.key === "a") {
    e.preventDefault();
    // Select all numbers
    const container = e.target.parentElement.parentElement;
    const selection = window.getSelection();
    const range = document.createRange();
    range.selectNodeContents(container);
    selection.removeAllRanges();
    selection.addRange(range);
  }

  // Handle Enter key
  if (e.key === "Enter" && e.target.value) {
    e.preventDefault();
    const existingNumbers = form.array_number ? form.array_number + "," : "";
    editNumber(existingNumbers + e.target.value);
    // Clear the input field
    e.target.value = "";
  }
}

function editNumber(e) {
  let value = typeof e === "object" ? e.target.value : e;

  // Remove all symbols except numbers, commas, spaces, and dashes
  value = value
    .replace(/[^\d,\s-]/g, "")
    .replace(/-/g, ",")
    .split(/[,\s]+/)
    .filter(Boolean);

  value = value.map((number) => {
    // Remove any remaining spaces or dashes
    number = number.replace(/[\s-]/g, "");

    if (number.startsWith("6")) {
      // For numbers starting with 601x (12 chars limit)
      if (/^60[1][0-9]/.test(number)) {
        return number.substring(0, 12);
      }
      return number;
    } else if (number.startsWith("0")) {
      // For numbers starting with 01x (11 chars limit)
      if (/^0[1][0-9]/.test(number)) {
        return "6" + number.substring(0, 11);
      }
      return "6" + number;
    } else if (/^[1][0-9]/.test(number)) {
      // For numbers starting with 1x (10 chars limit)
      return "60" + number.substring(0, 10);
    }
    return number;
  });

  // Remove duplicates using Set
  value = [...new Set(value)];

  // Update form value
  form.array_number = value.join(",");
}

function removeNumber(numberToRemove) {
  const numbers = form.array_number.split(",").filter(Boolean);
  form.array_number = numbers.filter((num) => num !== numberToRemove).join(",");
}

const form = useForm({
  message: "",
  option: "",
  file_upload: [],
  caption: "",
  view_once: false,
  compress: true,
  number: "",
  array_number: "",
});

const onSubmit = async () => {
  try {
    loading.value = true;
    await form.post(route("whatsapp.store"), {
      onSuccess: () => {
        loading.value = false;
        form.reset();
      },
    });
    // response.value = data;
    // if (response.value) {
    //   loading.value = false;
    //   form.number = "";
    //   form.reset();
    // }
  } catch (error) {
    console.error("Error:", error);
  }

  // axios
  //   .post(route("whatsapp.store", form))
  //   .then((response) => {
  //     loading.value = false;
  //     console.log(response);
  //   })
  //   .catch((error) => console.log(error));
};

const numberInput = ref(null);

function handleBackspace(e) {
  // Only handle backspace if content is selected
  if (window.getSelection().toString().length > 0) {
    e.preventDefault();
    form.array_number = "";
    if (numberInput.value) {
      numberInput.value.value = "";
    }
    return;
  }
}

function handleDelete(e) {
  if (window.getSelection().toString().length > 0) {
    e.preventDefault();
    form.array_number = "";
    if (numberInput.value) {
      numberInput.value.value = "";
    }
  }
}

function handleInputBackspace(e) {
  const numbers = form.array_number.split(",").filter(Boolean);

  // Only delete last number if input is empty and backspace is pressed
  if (e.target.value === "" && numbers.length > 0) {
    e.preventDefault(); // Prevent double backspace
    numbers.pop();
    form.array_number = numbers.join(",");
  }
}

function clearAllNumbers() {
  form.array_number = "";
  if (numberInput.value) {
    numberInput.value.value = "";
  }
}
</script>

<template>
  <Head title="Whatsapp Blasting" />

  <AuthenticatedLayout :auth="$page.props.auth">
    <div class="pt-8 pb-2">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
          <section>
            <header>
              <h2 class="text-lg font-medium text-gray-900">
                Whatsapp Blasting
              </h2>

              <p class="mt-1 text-sm text-gray-600">Send whatsapp</p>
            </header>

            <form
              @submit.prevent="onSubmit"
              enctype="multipart/form-data"
              class="mt-6 space-y-6"
              @change="onChange"
            >
              <div>
                <InputLabel for="number" value="Blasting Number" />

                <SelectInput
                  id="number"
                  class="mt-1 block w-full"
                  v-model="form.number"
                  required
                >
                  <option
                    v-for="number in props.whatsappNumber"
                    :disabled="number.first_whatsapp_batches?.isActive"
                    :value="number.id"
                    :hidden="
                      !(
                        $page.props.auth.role.name === 'Admin' ||
                        number.user_id === $page.props.auth.user.id
                      )
                    "
                  >
                    {{ number.name }}
                    <span v-if="number.first_whatsapp_batches?.isActive">
                      - number blasting in progress
                    </span>
                  </option>
                </SelectInput>

                <InputError class="mt-2" :message="form.errors.name" />
              </div>

              <div v-if="['3', '4'].indexOf(form.number) > -1">
                <div class="flex justify-between items-center">
                  <InputLabel for="array_number" value="Number" />
                  <button
                    type="button"
                    @click="clearAllNumbers"
                    class="text-gray-500 hover:text-red-600 transition-colors"
                    title="Clear all numbers"
                  >
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke-width="1.5"
                      stroke="currentColor"
                      class="w-5 h-5"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"
                      />
                    </svg>
                  </button>
                </div>

                <div
                  class="mt-1 block w-full border border-green-300 rounded-md p-2 min-h-[42px] focus-within:ring-2 focus-within:ring-green-500 focus-within:border-green-500 user-select-all bg-white"
                  @keydown.backspace="handleBackspace"
                  @keydown.delete="handleDelete"
                  tabindex="0"
                >
                  <div class="flex flex-wrap gap-2">
                    <!-- Number tags -->
                    <div
                      v-for="number in form.array_number
                        .split(',')
                        .filter((n) => n)"
                      :key="number"
                      class="bg-green-50 border border-green-200 text-green-800 rounded-md px-2 py-1 text-sm flex items-center gap-1"
                    >
                      <span>{{ number }}</span>
                      <button
                        type="button"
                        @click="removeNumber(number)"
                        class="text-green-500 hover:text-green-700 font-bold"
                      >
                        ×
                      </button>
                    </div>

                    <!-- Input field -->
                    <input
                      type="text"
                      class="flex-1 outline-none border-none focus:ring-0 min-w-[150px] text-sm text-green-800 placeholder-green-400"
                      placeholder="Enter numbers"
                      @keydown="handleInputKeydown"
                      @keydown.backspace="handleInputBackspace"
                      @keydown.delete="handleDelete"
                      @paste="handlePaste"
                      ref="numberInput"
                    />
                  </div>
                </div>

                <InputError class="mt-2" :message="form.errors.array_number" />
              </div>

              <div>
                <InputLabel for="option" value="Blasting Option" />

                <!-- <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" 
                                    autofocus /> -->

                <SelectInput
                  id="option"
                  class="mt-1 block w-full"
                  v-model="form.option"
                  required
                >
                  <option value="message">Message</option>
                  <option value="photo">Photo</option>
                  <!-- <option value="video">Video</option> -->
                </SelectInput>

                <InputError class="mt-2" :message="form.errors.name" />
              </div>

              <div v-if="form.option === 'message'">
                <InputLabel for="message" value="Message" />

                <TextArea
                  id="message"
                  type="text"
                  class="mt-1 block w-full"
                  v-model="form.message"
                  required
                />

                <InputError class="mt-2" :message="form.errors.message" />
              </div>

              <div v-if="['photo', 'video'].indexOf(form.option) > -1">
                <div>
                  <InputLabel for="message" value="Message" />

                  <TextArea
                    id="message"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.message"
                    required
                  />

                  <InputError class="mt-2" :message="form.errors.message" />
                </div>

                <div v-if="form.option === 'photo'" class="pt-5">
                  <InputLabel for="file_upload" value="Image" />

                  <FileInput
                    id="file_upload"
                    type="file"
                    class="mt-1 block w-full"
                    accept="image/*"
                  />

                  <InputError
                    class="mt-2"
                    :file_upload="form.errors.file_upload"
                  />
                </div>

                <div v-if="form.option === 'video'" class="pt-5">
                  <InputLabel for="file_upload" value="Video" />

                  <TextInput
                    id="file_upload"
                    type="file"
                    class="mt-1 block w-full"
                    v-model="form.file_upload"
                    accept="video/*"
                  />

                  <InputError
                    class="mt-2"
                    :file_upload="form.errors.file_upload"
                  />
                </div>
              </div>

              <div class="flex items-center gap-4">
                <div v-if="!loading">
                  <PrimaryButton
                    :disabled="form.processing"
                    v-if="
                      $page.props.auth.role.name === 'Admin' ||
                      $page.props.auth.can['whatsapp.view']
                    "
                  >
                    Send
                  </PrimaryButton>
                </div>
                <div v-if="loading">
                  <HalfCircleSpinner
                    :animation-duration="1000"
                    :size="30"
                    color="#17e083"
                  />
                </div>
                <SecondaryButton @click="back"> Cancel </SecondaryButton>
                <!-- <button @click="testLog()">
                                    test
                                </button> -->
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<style scoped>
input::placeholder {
  color: #9ca3af;
}

input:focus {
  outline: none;
}

.user-select-all {
  user-select: all;
  -webkit-user-select: all;
  -moz-user-select: all;
  -ms-user-select: all;
}
</style>

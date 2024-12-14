<script setup>
import { ref } from "vue";

const props = defineProps({
  modelValue: {
    type: String,
    default: "",
  },
  placeholder: {
    type: String,
    default: "Enter numbers",
  },
});

const emit = defineEmits(["update:modelValue"]);

const numberInput = ref(null);

function handlePaste(e) {
  e.preventDefault();
  const pastedText = e.clipboardData.getData("text");
  const existingNumbers = props.modelValue ? props.modelValue + "," : "";
  editNumber(existingNumbers + pastedText);
  if (numberInput.value) {
    numberInput.value.value = "";
  }
}

function handleInputKeydown(e) {
  if (e.ctrlKey && e.key === "a") {
    e.preventDefault();
    const container = e.target.parentElement.parentElement;
    const selection = window.getSelection();
    const range = document.createRange();
    range.selectNodeContents(container);
    selection.removeAllRanges();
    selection.addRange(range);
  }

  if (e.key === "Enter" && e.target.value) {
    e.preventDefault();
    const existingNumbers = props.modelValue ? props.modelValue + "," : "";
    editNumber(existingNumbers + e.target.value);
    e.target.value = "";
  }
}

function editNumber(e) {
  let value = typeof e === "object" ? e.target.value : e;

  value = value
    .split(",")
    .map((segment) => {
      return segment.trim().replace(/[\s]/g, "").split("-").join("");
    })
    .filter(Boolean);

  value = value.map((number) => {
    number = number.replace(/\D/g, "");

    if (/^601[0-9]{9}$/.test(number)) {
      return number;
    } else if (/^601[0-9]{8}$/.test(number)) {
      return number;
    } else if (number.startsWith("1")) {
      return "60" + number;
    } else if (number.startsWith("0")) {
      return "6" + number;
    }
    return number;
  });

  value = [...new Set(value)];

  value = value.filter((number) => {
    return /^601[0-9]{8,9}$/.test(number);
  });

  emit("update:modelValue", value.join(","));
}

function removeNumber(numberToRemove) {
  const numbers = props.modelValue.split(",").filter(Boolean);
  emit(
    "update:modelValue",
    numbers.filter((num) => num !== numberToRemove).join(",")
  );
}

function handleBackspace(e) {
  if (
    e.target === e.currentTarget &&
    window.getSelection().toString().length > 0
  ) {
    e.preventDefault();
    emit("update:modelValue", "");
    if (numberInput.value) {
      numberInput.value.value = "";
    }
  }
}

function handleDelete(e) {
  if (window.getSelection().toString().length > 0) {
    e.preventDefault();
    emit("update:modelValue", "");
    if (numberInput.value) {
      numberInput.value.value = "";
    }
  }
}

function handleInputBackspace(e) {
  const numbers = props.modelValue.split(",").filter(Boolean);

  if (e.target.value === "" && numbers.length > 0) {
    e.preventDefault();
    numbers.pop();
    emit("update:modelValue", numbers.join(","));
  }
}

function clearAll() {
  emit("update:modelValue", "");
  if (numberInput.value) {
    numberInput.value.value = "";
  }
}
</script>

<template>
  <div class="flex justify-between items-center">
    <slot name="label"></slot>
    <button
      type="button"
      @click="clearAll"
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
    class="mt-1 block w-full border border-gray-300 focus-within:border-emerald-500 focus-within:ring-1 focus-within:ring-emerald-600 rounded-md shadow-sm user-select-all bg-white"
    @keydown.backspace="handleBackspace"
    @keydown.delete="handleDelete"
    tabindex="0"
  >
    <div class="flex flex-wrap gap-2 p-2">
      <div
        v-for="number in modelValue.split(',').filter((n) => n)"
        :key="number"
        class="bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-md px-2 py-1 text-sm flex items-center gap-1"
      >
        <span>{{ number }}</span>
        <button
          type="button"
          @click="removeNumber(number)"
          class="text-emerald-500 hover:text-emerald-700 font-bold"
        >
          ×
        </button>
      </div>

      <input
        type="text"
        class="flex-1 outline-none border-none focus:ring-0 min-w-[150px] text-sm text-gray-900 placeholder:text-gray-400"
        :placeholder="placeholder"
        @keydown="handleInputKeydown"
        @keydown.backspace="handleInputBackspace"
        @keydown.delete="handleDelete"
        @paste="handlePaste"
        ref="numberInput"
      />
    </div>
  </div>
</template>

<style scoped>
.user-select-all {
  user-select: all;
  -webkit-user-select: all;
  -moz-user-select: all;
  -ms-user-select: all;
}
</style>

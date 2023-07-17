<script>
export default {
    props: {
        modelValue: String,
        maxWidth: {
            type: Number,
            default: 300,
        },
    },
};
</script>

<template>
    <div class="flex items-center">
        <div class="flex w-full bg-white rounded-md shadow">
            <input class="relative px-6 py-3 w-full rounded-md focus:shadow-outline" autocomplete="off" type="text"
                name="search" placeholder="Search…" :value="modelValue"
                @input="$emit('update:modelValue', $event.target.value)" />
        </div>
    </div>
</template>

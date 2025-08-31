<script setup>
import { ref } from "vue";
import Picker from "@emoji-mart/react";
import data from "@emoji-mart/data";

const showPicker = ref(false);
const emit = defineEmits(["select"]);

const addEmoji = (emoji) => {
    emit("select", emoji.native);
    showPicker.value = false;
};
</script>

<template>
    <div class="relative inline-block">
        <!-- Dugme za otvaranje emoji izbornika -->
        <button
            @click="showPicker = !showPicker"
            class="col-span-1 ml-auto p-2 rounded-md hover:bg-gray-300 transition"
        >
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.182 15.182a4.5 4.5 0 01-6.364 0M21 12a9 9 0 11-18 0 9 9 0 0118 0zM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75zm-.375 0h.008v.015h-.008V9.75zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75zm-.375 0h.008v.015h-.008V9.75z"></path>
            </svg>
        </button>

        <!-- Emoji izbornik -->
        <div v-if="showPicker" class="absolute bottom-10 right-0 z-50 bg-white shadow-lg rounded-lg">
            <Picker :data="data" @emoji-select="addEmoji" />
        </div>
    </div>
</template>

<script setup>

import {highlightElement} from "@/Services/SyntaxHighlighting.js";
import {onMounted, ref} from "vue";
import {useClipboard} from "@/Composables/useClipboard.js";

let props = defineProps({
    code: String
})

let block = ref(null);

let {copy, copied, supported} = useClipboard(props.code)

onMounted(() => {
    highlightElement(block.value);
})

</script>

<template>
    <div>
        <header v-if="supported" class="bg-gray-800 border-b border-gray-700 flex justify-end px-2 py-1 text-white text-xs">
            <button class="hover:bg-gray-600 px-2 rounded" @click="copy">{{ copied ? 'Copied' : 'Copy' }}</button>
        </header>
        <pre><code ref="block">{{ code }}</code></pre>
    </div>
</template>

<style scoped>

</style>

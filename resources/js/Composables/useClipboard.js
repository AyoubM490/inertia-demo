import {onMounted, ref} from "vue";
import {highlightElement} from "@/Services/SyntaxHighlighting.js";

export function useClipboard(text) {
    let copied = ref(false);

    let supported = navigator && 'clipboard' in navigator;

    let copy = () => {
        if (supported) {
            navigator.clipboard.writeText(text)

            copied.value = true

            setTimeout(() => {
                copied.value = false
            }, 3000)

            alert("copied")

            return
        }

        alert('Apologies, your browser does not support the Clipboard API.')
    }

    return {copied, copy, supported}

}

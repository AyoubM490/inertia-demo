import hljs from "highlight.js/lib/core";
import javascript from "highlight.js/lib/languages/javascript"
import php from "highlight.js/lib/languages/php"
import yaml from "highlight.js/lib/languages/yaml"
import html from "highlight.js/lib/languages/xml"

import "highlight.js/styles/github-dark.css";

hljs.registerLanguage("php", php);
hljs.registerLanguage("javascript", javascript);
hljs.registerLanguage("html", html);
hljs.registerLanguage("yaml", yaml);


export function highlight(selector) {
    if (! selector) {
        hljs.highlightAll();

        return;
    }

    document.querySelectorAll(selector + ' pre code').forEach(highlightElement);
}

export function highlightElement(element) {
    hljs.highlightElement(element);
}

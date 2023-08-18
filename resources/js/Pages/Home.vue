<script setup>
import Highlight from "@/Components/Highlight.vue";

let snippet = `
    class Example
    {
        public function __construct()
        {
            //
        }
    }
`.trim();
</script>


<template>
    <Head title="Home">
        <meta type="description" content="Home information" head-key="description"/>
    </Head>
    <h1 class="text-3xl">Blog</h1>
    <Highlight :code="snippet" />
</template>

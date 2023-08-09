<script setup>
</script>
<template>
    <Link class="text-black hover:underline" :class="{'font-bold underline': active}"><slot />
    </Link>
</template>
<script>
export default {
    name: 'NavLink',
    props: {
        active: Boolean
    }
}
</script>

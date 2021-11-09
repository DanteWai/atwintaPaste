<template>
    <div>
        <template v-for="(link, index) in links">
            <a class="footer__link" :href="link.href" >{{ link.title }}</a>
            <span class="footer__divider" v-if="index !== limit">/</span>
        </template>
    </div>
</template>

<script setup>
const {links} = defineProps({
    links: {type: Array, required: true}
})

const limit = links.length -1
</script>

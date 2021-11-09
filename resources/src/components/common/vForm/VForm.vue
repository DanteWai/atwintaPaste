<template>
    <form @submit.prevent="submit" class="form" action="">
        <slot/>
        <div class="form__errors" v-if="$slots.errors">
            <slot name="errors"></slot>
        </div>
    </form>
</template>

<script>
export default {
    name: "VForm",
    emits:['submit'],
    inheritAttrs:false,
    setup(props, {emit}) {
        const submit = (e) => {
            emit('submit', e)
        }

        return {submit}
    }
}
</script>



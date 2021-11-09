<template>
    <form @submit.prevent="$emit('submit',$event)" class="form" action="">
        <slot/>
        <div class="form__errors" v-if="$slots.errors">
            <slot name="errors"></slot>
        </div>
    </form>
</template>

<script>
export default {
    name: "VForm",
    emits:['submit']
}
</script>



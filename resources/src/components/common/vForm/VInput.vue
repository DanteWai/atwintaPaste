<template>
    <div class="form__input-wrapper">
        <input class="form__input"
               type="text"
               v-bind="$attrs"
               :value="value"
               @change="changeHandler">
        <span v-if="error && trigger" class="form__error">{{ error }}</span>
    </div>
</template>

<script>
import {ref} from "vue";

export default {
    name: "VInput",
    emits: ['update:value'],
    props: {
        value: {
            type: String,
            required: true
        },
        error: {
            type: String,
            default: ''
        }
    },
    inheritAttrs: false,
    setup(props, {emit}) {
        const trigger = ref(false)

        const changeHandler = (e) => {
            emit('update:value', e.target.value)
            trigger.value = true
        }

        return {trigger, changeHandler}
    }
}
</script>


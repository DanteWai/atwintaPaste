<template>
    <div class="switch-wrapper">
        <label class="switch" v-bind="$attrs">
            <input class="switch__input" type="checkbox"
                   :value="value"
                   @change="changeHandler"
            >
            <span class="switch__slider"></span>
        </label>
    </div>

</template>

<script>
export default {
    name: "BaseSwitcher",
    emits: ['update:value'],
    props: {
        value: {
            type: Boolean,
            required: true
        },
    },
    inheritAttrs: false,
    setup(props, {emit}) {

        const changeHandler = (e) => {
            emit('update:value', e.target.checked)
        }

        return {changeHandler}
    }
}
</script>


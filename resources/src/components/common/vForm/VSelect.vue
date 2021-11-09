<template>
    <div class="form__select-wrapper">
        <select class="form__select" v-bind="$attrs" :value="value" @change="changeHandler">
            <option value="" v-if="empty">{{empty}}</option>
            <template v-for="o in options">
                <option :value="o.id" v-if="!toRemove[o.title]">{{o.title}}</option>
            </template>
        </select>

        <span v-if="error && trigger" class="form__error">{{ error }}</span>
    </div>
</template>

<script>
import {computed, ref} from "vue";

export default {
    name: "VSelect",
    emits: ['update:value'],
    props: {
        value: {
            type: String,
            required: true
        },
        options:{
            type:Array,
            default:[],
        },
        empty: {
            type: String,
            default: ''
        },
        error: {
            type: String,
            default: ''
        },
        remove: {
            type: Array,
            default: []
        }
    },
    inheritAttrs: false,
    setup(props, {emit}) {
        const trigger = ref(false)

        const changeHandler = (e) => {
            emit('update:value', e.target.value)
            trigger.value = true
        }

        const toRemove = computed(() => {
            return props.remove.reduce((sum, el) => {
                sum[el] = true
                return sum
            }, {})
        })

        return {trigger, changeHandler, toRemove}
    }
}
</script>

<style scoped>

</style>

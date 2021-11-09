<template>
    <slot v-bind="{
        isValid,
        errors,
        activateTrigger,
        resetTrigger,
        globalTrigger,
        watchFieldError
    }"/>
</template>

<script>
import {computed, ref, watchEffect} from "vue";
import * as validators from "../../../untils/validators";
import {isEmpty} from 'lodash'

export default {
    name: "FormValidateProvider",
    emits: ['form:valid', 'form:invalid'],
    props: {
        fields: {
            type: Object,
            required: true,
        },
        rules: {
            type: Object,
            required: true,
        }
    },
    setup(props, {emit}) {
        const globalTrigger = ref(false)

        const validateFields = computed(() => {
            return props.rules ? Object.keys(props.rules) : []
        })

        const errors = computed(() => {
            if(!validateFields.value.length) return null

            let computed = validateFields.value.reduce((errors, field) => {

                let fieldErrors = props.rules[field].reduce((accumulateErrors, rule) => {

                    let validResult = validators[rule](props.fields[field], field)

                    if (validResult !== true) {
                        accumulateErrors.push(validResult)
                    }

                    return accumulateErrors
                }, [])


                if (fieldErrors.length) {
                    errors[field] = fieldErrors
                }

                return errors
            }, {})

            return isEmpty(computed) ? null : computed
        })


        const isValid = computed(() => !Boolean(errors.value))

        watchEffect(
            () => {
                isValid.value ? emit('form:valid') : emit('form:invalid', errors.value)
            }
        )

        const activateTrigger = () => {
            globalTrigger.value = true
        }

        const resetTrigger = () => {
            globalTrigger.value = false
        }

        const watchFieldError = (field) => computed(() => {
            return errors.value.hasOwnProperty(field)
                ? errors.value[field][0]
                : ''
        })

        return {globalTrigger, activateTrigger, resetTrigger, isValid, errors, watchFieldError}
    },

}
</script>

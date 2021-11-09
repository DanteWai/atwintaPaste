<template>
    <base-page-title>Registration page</base-page-title>
    <form-validate-provider :fields="form" :rules="rules">
        <template #default="{ isValid, errors, globalTrigger, activateTrigger, watchFieldError }">
            <v-form @submit="loginSubmit($event, isValid, activateTrigger)">
                <form-section>
                    <v-label for="login">Login</v-label>
                    <v-input id="login" name="login" v-model:value="form.login" :error="errors?.login?.[0]"/>
                </form-section>
                <form-section>
                    <v-label for="email">Email</v-label>
                    <v-input id="email" name="email" type="text" v-model:value="form.email" :error="errors?.email?.[0]"/>
                </form-section>
                <form-section>
                    <v-label for="password">Password</v-label>
                    <v-input id="password" name="password" type="password" v-model:value="form.password"
                             :error="errors?.password?.[0]"/>
                </form-section>
                <form-section>
                    <v-button>Login</v-button>
                </form-section>
                <template #errors v-if="globalTrigger">
                    <template v-for="errorField in errors">
                        <p v-for="error in errorField">{{ error }}</p>
                    </template>
                </template>
            </v-form>
        </template>
    </form-validate-provider>
</template>

<script setup>
import {
    FormValidateProvider,
    VForm,
    FormSection,
    VInput,
    VLabel,
    VButton,
} from "../../components/common/vForm";

import {reactive} from 'vue';
import {userRegistration} from "../../composables/useUser";
import {addAlert} from "../../composables/useAlert";
import {authMessages} from "../../config/messages";
import {useRouter} from "vue-router";

const router = useRouter()

const form = reactive({
    login: '',
    password: '',
    email: '',
})

const rules = {
    login: ['required'],
    password: ['required'],
    email: ['required', 'email'],
}

const loginSubmit = async (e, isValid, trigger) => {
    if (!isValid) {
        return trigger()
    }

    let {error} = await userRegistration({
        login: form.login,
        password: form.password,
        email: form.email
    })

    if (error) {
        addAlert({text: error.message})
        form.password = ''
    } else {
        addAlert({text: authMessages.success, type:'success'})
        await router.push('/')
    }

}
</script>

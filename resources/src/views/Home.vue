<template>
    <page-layout class="page-home" title="New paste">
        <template #header="{title}">
            <base-page-title no-border>{{ title }}</base-page-title>
            <div class="page-home__syntax-switch">
                <span class="page-home__syntax-label">Syntax Highlighting</span>
                <base-switcher v-model:value="highlight"/>
            </div>
        </template>


        <paste-area :key="timestamp" ref="$textarea" v-model:text="form.content" :highlight="highlight"
                    :lang="activeLang"></paste-area>


        <base-page-title>Optional Paste Settings</base-page-title>

        <div class="page-home__columns">
            <form-validate-provider :fields="form" :rules="rules">
                <template #default="{ isValid, errors, globalTrigger, resetTrigger, activateTrigger, watchFieldError }">

                    <v-form @submit="formSubmit($event, isValid, activateTrigger, resetTrigger)">

                        <form-section>
                            <v-label for="title">Paste Name / Title::</v-label>
                            <v-input id="title" name="title" v-model:value="form.title"/>
                        </form-section>

                        <form-section>
                            <v-label for="lang">Syntax Highlighting:</v-label>
                            <v-select id="lang" name="lang" v-model:value="form.lang_id" :options="meta.langs"
                                      empty="none"/>
                        </form-section>

                        <form-section>
                            <v-label for="expiration_time">Paste Expiration:</v-label>
                            <v-select id="expiration_time" name="expiration_time" v-model:value="form.expiration_time"
                                      :options="expiration_times" empty="Ever"/>
                        </form-section>

                        <form-section>
                            <v-label for="access">Paste Exposure:</v-label>
                            <v-select id="access" name="access" v-model:value="form.access_id" :options="meta.accesses"
                                      :remove="isLogged ? [] : ['unlisted']"/>
                        </form-section>

                        <form-section>
                            <v-button>
                                Create New Paste
                            </v-button>
                        </form-section>


                        <template #errors v-if="globalTrigger">
                            <template v-for="errorField in errors">
                                <p v-for="error in errorField">{{ error }}</p>
                            </template>
                        </template>
                    </v-form>
                </template>
            </form-validate-provider>
            <div class="page-home__right-column">
                <Permission :roles="['logged-in']">

                    <template #no-access>
                        <router-link class="btn" :to="{name:'Register'}">Sign up</router-link>
                        <span> or </span>
                        <router-link class="btn" :to="{name:'Login'}">Login</router-link>
                    </template>
                </Permission>
            </div>
        </div>
        <base-info-area v-if="!isLogged">
            You are currently not logged in, this means you can not edit or delete anything you paste.
        </base-info-area>
    </page-layout>
</template>

<script setup>

import PageLayout from "../layout/PageLayout";
import PasteArea from "../components/common/paste/PasteArea";
import {computed, onMounted, reactive, ref} from "vue";

import {
    FormValidateProvider,
    VForm,
    FormSection,
    VInput,
    VLabel,
    VButton,
    VSelect,
} from "../components/common/vForm/";

import {useUser} from "../composables/useUser";
import Permission from "../components/common/permission/Permission";
import {addPaste, getMeta, getMetaState} from "../composables/usePaste";
import {addAlert} from "../composables/useAlert";

const {isLogged, user} = useUser()
const meta = getMetaState()
const timestamp = ref(Date.now())

const highlight = ref(false)

const expiration_times = [
    {id: 600000, title: '10 Minutes'},
    {id: 3.6e+6, title: '1 Hour'},
    {id: 1.08e+7, title: '3 Hour'},
    {id: 6.048e+8, title: '1 Week'},
    {id: 2.628e+9, title: '1 Month'},
]

const form = ref({
    title: '',
    content: '',
    access_id: `1`,
    lang_id: '',
    expiration_time: '',
})

const activeLang = computed(() => {
    return form.value.lang_id
        ? meta.value.langs.find(el => el.id == form.value.lang_id).alias
        : ''
})

const rules = {
    title: ['required'],
    content: ['required'],
}


const formSubmit = async (e, isValid, trigger, reset) => {
    if (!isValid) {
        return trigger()
    }

    let request = {...form.value}


    if (request.lang_id) request.lang_id = Number(request.lang_id)
    if (request.access_id) request.access_id = Number(request.access_id)
    if (request.expiration_time) {
        request.expiration_time = Number(request.expiration_time) + Date.now()
        request.expiration_time = ~~(request.expiration_time / 1000)
    }


    if (isLogged) {
        request.user_id = user.value.id
    }

    let {data, error} = await addPaste(request)

    if (error) {
        addAlert({text: 'Error'})
    } else {
        reset()
        addAlert({text: 'Paste added successfully', type: 'success'})

        form.value = {
            title: '',
            content: '',
            access_id: `1`,
            lang_id: '',
            expiration_time: '',
        }

        highlight.value = false

        timestamp.value = Date.now()
    }


}

onMounted(getMeta)

</script>

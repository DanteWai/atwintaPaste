<template>
    <template v-if="init">
        <page-layout v-if="paste" class="page-paste" :title="paste.title">
            <div class="page-paste__header">
                <span class="page-paste__user" v-if="paste.user">
                    {{ paste.user.login }}
                </span>
                <span class="page-paste__date">
                    {{ date.format(new Date(paste.created_at), 'YY-MM-DD') }}
                </span>
            </div>

            <Permission :roles="['owner']" :entityOwnerId="paste?.user?.id">
                <base-info-area>
                    Its your paste
                </base-info-area>
            </Permission>

            <div class="page-paste__paste">
                <highlightjs :language='paste?.lang?.alias || ""' :code="paste?.content || ''"/>
            </div>
        </page-layout>
        <not-found v-else/>
    </template>
</template>

<script setup>
import {useRoute} from "vue-router";
import PageLayout from "../../layout/PageLayout";
import {ref, watch, watchEffect} from "vue";
import {getPaste} from "../../composables/usePaste";
import NotFound from "../NotFound";
import date from 'date-and-time'
import Permission from "../../components/common/permission/Permission";

const route = useRoute()
const {slug} = route.params
const init = ref(false)
const paste = ref(null)

getData()

watch(
    () => route.params.slug,
    (newValue) => (newValue && getData())
)

async function getData(){
    try{
        let {data, error} = await getPaste(route.params.slug)
        !error && (paste.value = data)
    } finally {
        init.value = true

    }
}



</script>



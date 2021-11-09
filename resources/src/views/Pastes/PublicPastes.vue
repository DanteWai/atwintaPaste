<template>
    <page-layout title="Public pastes">
        <table class="pastes">
            <thead>
            <tr>
                <td>Name / title</td>
                <td>Posted</td>
                <td>Syntax</td>
            </tr>
            </thead>
            <tbody>
            <tr class="pastes__item" v-for="p in pastes">
                <td>
                    <router-link class="pastes__link" :to="{name:'PasteView', params:{slug:p.slug}}">{{ p.title }}
                    </router-link>
                </td>
                <td>{{ date.format(new Date(p.created_at), 'YY-MM-DD') }}</td>
                <td>{{ p.lang?.title || 'raw' }}</td>
            </tr>
            </tbody>
        </table>

        <div class="pastes-nav" v-if="meta">
            <Pagination :count="meta.total"
                        :per-page="meta.per_page"
                        :page="meta.current_page"
                        @change-page="changePage"
            />
        </div>
    </page-layout>


</template>

<script setup>
import PageLayout from "../../layout/PageLayout";
import {getPublicPastes} from "../../composables/usePaste";
import {ref} from "vue";
import date from 'date-and-time'
import Pagination from "../../components/common/pagination/Pagination";

const pastes = ref([])
const meta = ref(null)
const links = ref(null)

async function getPublic(page) {
    let {data, error} = await getPublicPastes(page)

    if (!error) {
        pastes.value = data.data
        meta.value = data.meta
        links.value = data.links
    }
}

getPublic()



const prevPage = () => {
    if (meta.value?.current_page > 1) {
        getPublic(meta.value.current_page - 1)
    }
}

const nextPage = () => {
    if (meta.value?.current_page < meta.value?.last_page) {
        getPublic(meta.value.current_page + 1)
    }
}
</script>

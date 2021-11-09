<template>
    <page-layout title="My profile">
        <div>
            <a @click.prevent="logout" href="#">logout</a>
        </div>
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
import {userLogOut} from "../../composables/useUser";
import {useRouter} from "vue-router";
import PageLayout from "../../layout/PageLayout";
import {getUserPastes} from "../../composables/usePaste";
import {ref} from "vue";
import date from 'date-and-time'
import Pagination from "../../components/common/pagination/Pagination";

const router = useRouter()

const pastes = ref([])
const meta = ref(null)
const links = ref(null)

async function getPrivate(page) {
    let {data, error} = await getUserPastes(page)

    if (!error) {
        pastes.value = data.data
        meta.value = data.meta
        links.value = data.links
    }
}

getPrivate()

const changePage = ({page}) => {
    getPrivate(page)
}


const logout = async () => {
    await userLogOut()
    await router.push('/')
}


</script>


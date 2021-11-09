<template>
    <aside class="sidebar">
        <div class="sidebar__title">
            <router-link class="sidebar__link" :to="{name: 'PublicPastes'}">Public Pastes</router-link>
            <ul class="sidebar__list">
                <li class="sidebar__item" v-for="paste in pastes">
                    <router-link class="sidebar__item-link" :to="{name:'PasteView', params:{slug:paste.slug}}">
                        {{ paste.title }}
                    </router-link>
                    <div class="sidebar__item-details">
                        {{ `${paste.lang?.title || 'raw'} | ${date.format(new Date(paste.created_at), 'YY-MM-DD')}` }}
                    </div>
                </li>
            </ul>
        </div>
        <div class="sidebar__title" v-if="isLogged">
            <router-link class="sidebar__link" :to="{name: 'Profile'}">My Pastes</router-link>
            <ul class="sidebar__list">
                <li class="sidebar__item" v-for="paste in userPastes">
                    <router-link class="sidebar__item-link" :to="{name:'PasteView', params:{slug:paste.slug}}">
                        {{ paste.title }}
                    </router-link>
                    <div class="sidebar__item-details">
                        {{ `${paste.lang?.title || 'raw'} | ${date.format(new Date(paste.created_at), 'YY-MM-DD')}` }}
                    </div>
                </li>
            </ul>
        </div>
    </aside>
</template>

<script setup>
import {getPublicPastes, getUserPastes} from "../../../composables/usePaste";
import {ref, watch} from "vue";
import date from 'date-and-time'
import {isLogged} from "../../../composables/useUser";

const pastes = ref([])
const userPastes = ref([])

async function getPublic() {
    let {data, error} = await getPublicPastes()
    if (!error) {
        pastes.value = data.data
    }
}

async function getPrivate() {
    let {data, error} = await getUserPastes()
    if (!error) {
        userPastes.value = data.data
    }
}

getPublic()

watch(
    isLogged,
    (newValue) => {
        if(newValue){
            getPrivate()
        }
    }
)


if (isLogged.value) {
    getPrivate()
}

</script>

<style scoped lang="scss">

</style>

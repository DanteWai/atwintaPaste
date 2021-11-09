<template>
    <aside class="sidebar">
        <div class="sidebar__block">
            <router-link class="sidebar__link" :to="{name: 'PublicPastes'}">Public Pastes</router-link>
            <ul class="sidebar__list">
                <li class="sidebar__item" v-for="paste in pasteState.publicPastes">
                    <router-link class="sidebar__item-link" :to="{name:'PasteView', params:{slug:paste.slug}}">
                        {{ paste.title }}
                    </router-link>
                    <div class="sidebar__item-details">
                        {{ `${paste.lang?.title || 'raw'} | ${date.format(new Date(paste.created_at), 'YY-MM-DD')}` }}
                    </div>
                </li>
            </ul>
        </div>
        <div class="sidebar__block" v-if="isLogged">
            <router-link class="sidebar__link" :to="{name: 'Profile'}">My Pastes</router-link>
            <ul class="sidebar__list">
                <li class="sidebar__item" v-for="paste in pasteState.privatePastes">
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
import {getPasteState} from "../../../composables/usePaste";
import date from 'date-and-time'
import {isLogged, useUser} from "../../../composables/useUser";

const pasteState = getPasteState()
const user = useUser()




</script>



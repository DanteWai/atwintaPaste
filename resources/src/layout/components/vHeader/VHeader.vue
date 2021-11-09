<template>
    <header class="header">
        <nav class="nav container">
            <div class="nav__left">
                <div class="nav__logo" @click="$router.push('/')">
                    Awesome-pstb
                </div>
                <div class="nav__links">
                    <a class="nav__link" v-for="link in links" :href="link.href">{{ link.title }}</a>
                </div>
                <router-link class="nav__add-paste-btn" to="/">
                    paste
                </router-link>
            </div>
            <div class="nav__right">
                <Permission :roles="['logged-in']">

                    <user-info :user="user"/>

                    <template #no-access>

                        <div class="nav__sign">
                            <router-link class="nav__sign-btn nav__sign-in" :to="{name:'Login'}">Login</router-link>
                            <router-link class="nav__sign-btn nav__sign-up" :to="{name:'Register'}">Sign up</router-link>
                        </div>

                    </template>

                </Permission>
            </div>
        </nav>
    </header>
</template>

<script setup>
import Permission from "../../../components/common/permission/Permission";
import {getUser} from "../../../composables/useUser";
import UserInfo from "./UserInfo";

const user = getUser()

const links = []
</script>

<style scoped lang="scss">

</style>

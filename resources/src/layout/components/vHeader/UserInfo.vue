<template>
    <div class="header__user-info">
        <router-link class="header__user-link" :to="{name:'Profile'}">
            {{ user.login }}
        </router-link>

    </div>
</template>

<script>
export default {
    name: "UserInfo",
    props: {
        user: {
            type: Object,
            required: true
        }
    }
}
</script>

<style scoped>

</style>

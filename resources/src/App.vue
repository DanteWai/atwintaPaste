<template>
    <layout>
        <router-view/>
    </layout>
    <alerts/>
</template>

<script>
import Layout from "./layout/Layout";
import Alerts from "./layout/components/alert/Alert";
import {refreshPastes} from "./composables/usePaste";


export default {
    components: {Alerts, Layout},
    mounted() {
        refreshPastes()
    }
}
</script>



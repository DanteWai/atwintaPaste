<template>
    <layout>
        <router-view/>
    </layout>
    <alerts/>
</template>

<script>
import Layout from "./layout/Layout";
import Alerts from "./layout/components/alert/Alert";


export default {
    components: {Alerts, Layout},
}
</script>



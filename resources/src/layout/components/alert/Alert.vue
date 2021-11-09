<template>
    <div class="alerts">
        <div class="alert" :class="alert?.type" v-for="alert in alerts">
            {{ alert?.text }}
        </div>
    </div>
</template>

<script>
import {getAlerts} from "../../../composables/useAlert";


export default {
    name: "Alerts",
    setup() {
        return {alerts: getAlerts()}
    }
}
</script>

<style scoped lang="scss">
.alerts {
    z-index: 100;
    position: fixed;
    top: 20%;
    left: 50%;
    transform: translateX(-50%);

    .alert {
        background-color: #555;
        padding: 20px 40px;
        color: #fff;
        box-shadow: 0px 1px 4px rgba(0, 0, 0, 0.3);
        margin-bottom: 10px;
        cursor: pointer;
        text-align: center;
        min-width: 300px;

        &.success {
            background-color: #58b955;
        }

        &.error {
            background-color: #992a1f;
        }

        &.warning {
            background-color: #b95555;
        }
    }
}
</style>

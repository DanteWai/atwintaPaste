<template>
    <v-header/>
        <div class="main container">
            <div class="main__content">
                <slot/>
            </div>
            <side-bar class="main__sidebar"/>
        </div>
    <v-footer/>
</template>

<script>
import {VHeader, VFooter, SideBar} from "./components";
export default {
    name: "Layout",
    components: {VFooter, VHeader, SideBar}
}
</script>

<template>
    <div class="page">
            <div class="page__header">
                <slot name="header" :title="title">
                    <base-page-title v-if="title">
                        {{title}}
                    </base-page-title>
                </slot>
            </div>
            <slot></slot>

    </div>
</template>

<script>
export default {
    name: "PageLayout",
    props:{
        title:{
            type:String,
            default:'',
        },
    }
}
</script>

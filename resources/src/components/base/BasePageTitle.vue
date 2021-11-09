<template>
    <div class="page__title"
         :class="{'page__title_no-border': noBorder}"
    >
        <slot/>
    </div>
</template>

<script>
export default {
    name: "BasePageTitle",
    props:{
        noBorder:{
            type:Boolean,
            default:false
        }
    }
}
</script>

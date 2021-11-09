<template>
    <div class="pagination-wrapper">
        <div class="pagination" v-if="count > perPage">
            <div class="page arrow left-arrow" :class="{disabled:page === 1}" @click="changePage(page-1)">
                <svg class="h-5 w-5" x-description="Heroicon name: solid/chevron-left" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <template v-for="(p,key) in computedPages">
                <div class="page dot" v-if="page > 5 && key === 3">...</div>
                <div class="page dot" v-if="page > 5 && page < pages  - 3 && key === computedPages.length-3">...</div>
                <div class="page"
                     :class="{active:page === p}"
                     @click="changePage(p)">{{p}}</div>
            </template>


            <div class="page arrow right-arrow" :class="{disabled:page === pages}" @click="changePage(page+1)">
                <svg class="h-5 w-5" x-description="Heroicon name: solid/chevron-right" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                </svg>
            </div>
        </div>
    </div>
</template>

<script>
import {computed, onMounted, ref, toRefs} from "vue";

export default {
    name: "Pagination",
    props:{
        count:Number,
        perPage:Number,
        page:{
            type:Number,
            default:1
        }
    },
    setup(props,{emit}){
        const {perPage,count,page} = toRefs(props)
        const pages = computed(() => Math.ceil(count.value / perPage.value))
        const isMany = computed(() => pages > 10)


        const computedPages = computed(() => {
            if(pages.value <= 10) {
                return pages.value
            }
            else {
                return [
                    1,2,3,
                    ...getActualPages(),
                    pages.value-2,pages.value-1,pages.value
                ]
            }
        })

        function getActualPages(){
            if(page.value < 6) return [4,5,6]
            if(page.value >= pages.value - 3) return [pages.value-5,pages.value-4,pages.value-3]
            return [page.value-1,page.value,page.value+1]
        }



        function changePage(p){
            if(page.value !== p && p >= 1 && p <= pages.value){
                emit('changePage', {page:p, offset:(p - 1) * perPage.value, perPage:perPage.value, count:props.count})
            }

        }
//
        return { pages, computedPages, page, isMany, changePage }
    },

}
</script>

<style scoped lang="scss">
.pagination{
    font-family: Arial,serif;
    display: inline-flex;
}

.page{
    padding: 10px 18px;
    color: #6b7280;
    border: 1px solid #3e3e3e;
    margin-left: -1px;
    font-size: 0.9rem;
    cursor: pointer;
    &:hover{
        background: #f2f2f2;
    }
    &.active{
        color: #fff;
        cursor: default;
        background-color: #454a4f;
    }
    svg{
        height: 20px;
    }
}
.page.dot:hover{
    background: inherit;
}
.page.arrow{
    padding: 6px 10px;
    display: flex;
    align-items: center;
}
.arrow.disabled{
    &:hover{
        background: initial;
    }
    svg{
        fill:#ccc;
    }
}

</style>

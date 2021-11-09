<template>
    <div class="paste-area"  :class="{'paste-area_high':highlight && lang}">
        <textarea ref="$textarea" class="paste-area__text" name="paste" id="paste" cols="30" rows="10"
                  spellcheck="false" @input="keyPressHandler" @keydown.tab.prevent="tabHandler"
        >{{text}}</textarea>

        <template v-if="highlight && lang">
            <highlightjs :language='lang' :code="text" />
        </template>

    </div>
</template>

<script setup>
import {ref, computed, toRef} from "vue";

const props = defineProps({
    text:{
        type:String,
        required:true
    },
    highlight:{
        type:Boolean,
        default:false
    },
    lang:{
        type:String,
        default:''
    }
})



const emit = defineEmits(['update:text'])


const DEFAULT_HEIGHT= 300
const BORDER_HEIGHT = 2


const $textarea = ref(null)

const height = ref(DEFAULT_HEIGHT)
const cHeight = computed(() => height.value + 'px')

const tabHandler = () => {
    let code = $textarea.value.value
    let element = $textarea.value

    let before_tab = code.slice(0, element.selectionStart); // text before tab
    let after_tab = code.slice(element.selectionEnd, element.value.length); // text after tab
    let cursor_pos = element.selectionEnd + 1; // where cursor moves after tab - moving forward by 1 char to after tab
    element.value = before_tab + "\t" + after_tab; // add tab char
    // move cursor
    element.selectionStart = cursor_pos;
    element.selectionEnd = cursor_pos;

    emit('update:text', element.value)
}

const keyPressHandler = (e) => {
    emit('update:text', e.target.value)
    const CurrentHeight = $textarea.value.scrollHeight + BORDER_HEIGHT

    if(CurrentHeight > DEFAULT_HEIGHT && CurrentHeight !== height.value){
        height.value = CurrentHeight
    }
}
</script>

<style scoped lang="scss">
.paste-area__text{
    height: v-bind('cHeight');

}
.paste-area{
    height: v-bind('cHeight');

}
.paste-area :deep(.hljs){
    height: v-bind('cHeight');
}



</style>

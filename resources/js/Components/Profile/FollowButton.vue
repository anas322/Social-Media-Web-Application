<template>
    <div>
        <button v-text="buttonText" @click="handleRequest" :class="classes"></button>
    </div>
</template>

<script setup>

import { computed } from '@vue/reactivity';
import { Inertia } from '@inertiajs/inertia';

const props = defineProps({
    userObject:Object,
    isFollow:Boolean
})

const classes = computed(()=>{
    return buttonText.value == "Follow" ? "px-4 py-1 text-white font-bold bg-blue-500 rounded-md" : "px-4 py-1 text-blue-500 font-bold ring-1 ring-blue-500 rounded-md hover:bg-blue-500 hover:text-white transition "
})

const buttonText = computed(()=>{
    return props.isFollow ? "Unfollow" : "Follow";
})

const handleRequest  = () =>{
    Inertia.post('/follow/'+ props.userObject.id);
}
</script>

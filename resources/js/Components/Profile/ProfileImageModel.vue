<script setup>
    import { ref } from "vue";
    import { Link } from "@inertiajs/inertia-vue3";
    import { Inertia } from "@inertiajs/inertia";
    const props = defineProps({
        post:Object,
    })

    const emit = defineEmits(['cancelPreview'])

    const fireEmit = (e) =>{
    //   check if the the user target the right element first
        if(e.target.classList.contains('transparent-background')){
            emit('cancelPreview')
        }
    }       

    const deletePost = ()=>{
        Inertia.delete(route('post.delete',props.post.id))
        emit('cancelPreview')
    }

</script>


<template>
    <div class="fixed z-50 w-full right-0 top-0 left-0 bottom-0  transparent-background" @click="fireEmit">
        <div class=" w-3/4 md:w-2/4 h-3/4 overflow-y-auto  p-8 bg-slate-200 absolute rounded-lg left-2/4 top-2/4 -translate-y-2/4 -translate-x-2/4">
            <div class=" w-full h-3/4 overflow-y-auto rounded">
                <img :src="'/storage/' + post.image" alt="profile image" class="rounded-lg  h-full md:h-auto w-full">
            </div>
            <div class="bg-white mt-8 rounded-lg p-4">
                    <p class="capitalize text-lg text-blue-500">caption</p>

                    <p class="text-sm mt-4">{{post.caption}}</p>
            </div>

             <div class="mt-8 flex flex-wrap gap-4">
                <Link :href="route('post.edit',post)"
                    class="px-8 py-2 text-white font-semibold bg-blue-500 hover:bg-blue-600 rounded-full">
                Edit</Link>

                  <button @click="deletePost"
                    class="px-8 py-2 text-white font-semibold bg-red-500 hover:bg-red-600 rounded-full">
                Delete Post</button>
            </div>
        </div>
    </div>
</template>

<style scoped>
.transparent-background{
    background: rgba(0, 0, 0,0.2);
}
</style>
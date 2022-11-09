<script setup>
    import {
        ref
    } from "vue";
    import {
        Link
    } from "@inertiajs/inertia-vue3";
    import {
        Inertia
    } from "@inertiajs/inertia";
    const props = defineProps({
        post: Object,
        can: Boolean,
        assetUrl: String
    })

    const emit = defineEmits(['cancelPreview'])

    const fireEmit = (e) => {
        //   check if the the user target the right element first
        if (e.target.classList.contains('toggle-window')) {
            emit('cancelPreview')
        }
    }

    const deletePost = () => {
        Inertia.delete(route('post.delete', props.post.id))
        emit('cancelPreview')
    }

    const toggleDropDown = ref(true);

</script>


<template>
    <div class="toggle-window fixed z-50 w-full right-0 top-0 left-0 bottom-0 " style=" background: rgba(0, 0, 0,0.2);" @click="fireEmit">
        <span class="toggle-window absolute right-4 top-2 text-2xl hover:cursor-pointer py-1 px-2 rounded-lg transition duration-700 font-bold hover:bg-gray-500/25" @click="fireEmit">X</span>
        <div class="w-7/12 h-5/6 bg-white absolute rounded-lg left-2/4 top-2/4 -translate-y-2/4 -translate-x-2/4 shadow-md">
            <div class="grid grid-cols-12 grid-rows-6 auto-rows-min h-full">
                <div class="col-span-7 row-span-6">
                    <img :src="assetUrl + '/' + post.image" class="rounded-xl w-full h-full object-cover">
                </div>

                <div class="col-span-5 row-span-6 p-4 space-y-4 h-full">
                    <div class='flex items-center justify-between' >
                        <div class="flex items-center justify-start space-x-3">

                            <div>
                                <img :src="post.user.profile_photo_path ? assetUrl +'/' + post.user.profile_photo_path :assetUrl + '/default/default.png'"
                                class="w-12" style="clip-path:circle()">
                            </div>
                            <p class='text-slate-800 font-semibold'>{{ post.user.name }}</p>
                        </div>

                         <div class="relative" v-if="props.can">
                            <button  @click="toggleDropDown = !toggleDropDown" class="text-gray-600 dark:text-white  focus:ring-2 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button"><svg class="w-6 h-6 fill-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"></path></svg></button>

                            <!-- Dropdown menu -->
                            <div :class="{'hidden':toggleDropDown}" class="absolute -left-8 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 ">
                                <ul class="py-1 text-sm text-gray-700 dark:text-gray-200">
                                    <li>
                                        <button @click="deletePost" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 text-red-600 capitalize hover:underline hover:underline-offset-2">delete post</button>
                                    </li>
                                    <li>
                                        <Link :href="route('post.edit',post)" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600  capitalize text-blue-500 hover:underline hover:underline-offset-2">Edit Post</Link>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="h-full">
                        <div class=" space-y-5 mb-4 overflow-y-auto h-3/4">
                            <!-- list all the comments  -->

                            <div v-for="comment in post.comments" :key="comment.id" class='flex items-start  space-x-3'>
                                <div class='pt-1 flex-shrink-0'>
                                    <Link  :href="route('prof.index',comment.user)">
                                        <img :src="comment.user.profile_photo_path ? assetUrl + '/' + comment.user.profile_photo_path : assetUrl + '/default/default.png'"
                                        class="w-10" style="clip-path:circle()">
                                    </Link>
                                </div>

                                <div>
                                    <div class="flex flex-col space-y-1">
                                        <p class='text-slate-800 font-semibold'>{{comment.user.name}}<span
                                                class="text-xs pl-4 text-gray-400 font-normal">
                                            {{comment.created_at}}</span></p>
                                        <p class="text-md font-serif">{{comment.comment_text}}</p>

                                    </div>
                                </div>
                            </div>

                            <span v-if="post.comments.length <= 0" class="text-gray-500 text-center block">No Comments
                                😪</span>
                         
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>

</template>
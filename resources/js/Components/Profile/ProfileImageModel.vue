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

</script>


<template>
    <div class="toggle-window fixed z-50 w-full right-0 top-0 left-0 bottom-0 " style=" background: rgba(0, 0, 0,0.2);" @click="fireEmit">
        <div class="w-7/12 h-5/6 bg-white absolute rounded-lg left-2/4 top-2/4 -translate-y-2/4 -translate-x-2/4">
            <div class="grid grid-cols-12 h-full">
                <div class="col-span-7 overflow-y-auto">
                    <img :src="assetUrl + '/' + post.image" class="rounded-xl w-full h-full object-cover">
                </div>

                <div class="col-span-5 p-4 space-y-4 h-full overflow-y-auto relative">
                    <span class="toggle-window absolute right-3 text-lg hover:cursor-pointer py-1 px-2 rounded-lg transition duration-700 font-bold hover:bg-gray-500/25" @click="fireEmit">X</span>
                    <div class='flex items-center justify-start space-x-3' style='margin-top:-4px'>
                        <div>
                            <img :src="post.user.profile_photo_path ? assetUrl +'/' + post.user.profile_photo_path :assetUrl + '/default/default.png'"
                                class="w-12" style="clip-path:circle()">
                        </div>
                        <p class='text-slate-800'>{{ post.user.name }}</p>
                    </div>
                    <hr>
                    <div>
                        <div class=" space-y-5">
                            <!-- show the caption first  -->

                            <div class='flex items-start justify-start space-x-3'>
                                <div class='pt-1 flex-shrink-0'>
                                    <img :src="post.user.profile_photo_path ? assetUrl +'/' + post.user.profile_photo_path :assetUrl + '/default/default.png'"
                                        class="w-10" style="clip-path:circle()">
                                </div>

                                <div class="flex flex-col space-y-1">
                                    <p class='text-slate-800'>{{post.user.name}}<span
                                            class="text-xs pl-4 text-gray-400">
                                        </span>{{post.created_at}}</p>
                                    <p class="text-md font-serif">{{post.caption}}</p>
                                </div>
                            </div>

                            <!-- list all the comments  -->

                            <div v-for="comment in post.comments" :key="comment.id" class='flex items-start  space-x-3'>
                                <div class='pt-1 flex-shrink-0'>
                                    <img :src="comment.user.profile_photo_path ? assetUrl + '/' + comment.user.profile_photo_path : assetUrl + '/default/default.png'"
                                        class="w-10" style="clip-path:circle()">
                                </div>

                                <div>
                                    <div class="flex flex-col space-y-1">
                                        <p class='text-slate-800'>{{comment.user.name}}<span
                                                class="text-xs pl-4 text-gray-400">
                                            </span>{{comment.created_at}}</p>
                                        <p class="text-md font-serif">{{comment.comment_text}}</p>

                                    </div>
                                </div>
                            </div>

                            <span v-if="post.comments.length <= 0" class="text-gray-500 text-center block">No Comments
                                😪</span>

                        </div>

                        <div>
                            <hr>
                            <form>
                                <div class='flex items-center justify-between form'>
                                    <input type="hidden" name="postId" :value="post.id">
                                    <input type="text" name='comment_text' class='w-full border-none focus:ring-0'
                                        placeholder="Add a comment...😊">
                                    <input type="submit" class=' submit-comment text-blue-500 hover:cursor-pointer'
                                        value="Post" />
                                </div>
                                <span class='error text-red-600 text-sm'></span>
                            </form>
                        </div>

                        <div v-if="props.can" class="mt-8 flex flex-wrap gap-4">
                            <Link :href="route('post.edit',post)"
                                class="px-8 py-2 text-white font-semibold bg-blue-500 hover:bg-blue-600 rounded-full">
                            Edit</Link>

                            <button @click="deletePost"
                                class="px-8 py-2 text-white font-semibold bg-red-500 hover:bg-red-600 rounded-full">
                                Delete Post</button>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

</template>
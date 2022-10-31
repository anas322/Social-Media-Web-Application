<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue';
    import Pagination from '@/Components/Pagination.vue'
    import { computed } from '@vue/reactivity';
    import { usePage } from '@inertiajs/inertia-vue3';
    const props = defineProps({
        posts: Object,
        storagePath:String,
        users:Object,
    })
    
    //restore the proper profile picture of each user
    const restoreUserData = (id)=>{
        for (let i = 0; i < props.users.length; i++) {
                if(id == props.users[i].id)
                 return {
                    imgePath : props.storagePath + "/" + props.users[i].profile_photo_path,
                    name:props.users[i].name
                }
        }
    }

    //get the profile picture or use the default one 
    const userProfilePicture = computed(()=>{
        return usePage().props.value.user.profile_photo_path ? props.storagePath + '/' + $page.props.user.profile_photo_path : props.storagePath + '/' + 'default/default.png';
    })
</script>

<template>
    <AppLayout title="test">
        <section class="grid grid-cols-12 gap-x-6 my-2">
            <!-- side left -->
            <aside class="bg-slate-300 col-span-3 rounded-2xl"></aside>

            <!-- main  -->
            <div class="col-span-6">
                <!-- create post -->
                <div class="mb-4 px-4 py-3 bg-white rounded-full box-border">
                     <form>
                        <div class="flex items-center box-border">
                            <div>
                                <img :src="userProfilePicture" style="clip-path:circle()" class="w-12">
                            </div>
                            <textarea class="w-full focus:ring-0 resize-none align-center rounded-full border-none h-10"  placeholder="What's in your mind?"></textarea>
                            <button type="submit" class="h-auto text-white bg-indigo-600 rounded-full text-lg px-8 py-2">Post</button>
                        </div>
                     </form>   
                </div>

                <!-- posts  -->
                    <div class="space-y-4">
                        <article v-for="post in props.posts.data" :key="post.id" class="space-y-4 p-4 bg-white rounded-2xl">
                            <!-- header part  -->
                            <div class="flex space-x-4">
                                <div>
                                    <img :src="restoreUserData(post.user_id).imgePath" style="clip-path:circle()" class="w-12">
                                </div>
    
                                <div>
                                    <p><strong>{{restoreUserData(post.user_id).name}}</strong></p>
                                    <small class="text-gray-500 font-semibold">{{post.created_at}}</small>
                                </div>
                            </div>
    
                            <!-- picture  -->
                            <div>
                                <img :src="storagePath +'/'+ post.image" class="rounded-xl w-full">
                            </div>
                            
                            <!-- caption  -->
                            <div>
                                <p class="text-sm text-gray-600 font-semibold"> <strong class="text-base text-black pr-2">{{restoreUserData(post.user_id).name}}</strong>{{post.caption}}</p>
                            </div>
                        </article>
                        <Pagination class="mt-6" :links="props.posts.links" />
                    </div> 
               
            </div>

            <!-- side right  -->
            <aside class="bg-slate-300 col-span-3 rounded-2xl"></aside>
        </section>
    </AppLayout>

</template>

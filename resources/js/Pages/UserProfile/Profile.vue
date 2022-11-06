<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue';
    import ProfileImageModelVue from '@/Components/Profile/ProfileImageModel.vue';
    import FollowButton from "@/Components/Profile/FollowButton.vue";

    import {
        ref
    } from 'vue';
    import {
        Link
    } from "@inertiajs/inertia-vue3";

    const props = defineProps({
        profile: Object,
        posts: Object,
        userObject: Object,
        assetUrl: String,
        canEditProfile: Boolean,
        isFollow: Boolean,
        followingCount: Number,
        followersCount: Number,
        postsCount: Number,
        assetUrlProfile: String
    });

    let show = ref(false);
    let postInfo = ref({});
    const previewImage = (post) => {
        postInfo.value = post;
        show.value = true;
    }

</script>

<template>

    <AppLayout title="Profile">
        <div class="container mx-auto w-11/12 md:w-5/6 py-12 min-h-screen   ">
            <!-- header section -->
            <div class="md:grid md:grid-cols-12 flex flex-col">

                <div class="col-span-3  place-self-center">
                    <div class="w-full mx-auto">
                        <img :src="props.userObject.profile_photo_path ? props.assetUrl + '/' + props.userObject.profile_photo_path : props.assetUrl + '/default/default.png'" alt="image profile" loading="lazy" style="clip-path:circle()"
                            class="max-h-44">
                    </div>
                </div>

                <div class="md:col-span-9 mt-8 pl-8">

                    <div class="mb-6 flex justify-between">
                        <div>
                            <div class="flex space-x-8 ">
                                <h1 class="font-bold text-2xl pb-2 capitalize">{{props.userObject.name}}</h1>

                                <div v-if="props.canEditProfile">
                                    <Link :href="route('prof.edit',props.userObject)"
                                        class="px-8 py-1 text-gray-900 hover:bg-slate-700/5 font-normal ring-1 ring-slate-600  transition rounded-lg">
                                    Edit</Link>
                                </div>
                                <template v-if="!canEditProfile">
                                    <FollowButton :userObject="props.userObject" :isFollow="isFollow" />
                                </template>
                            </div>

                            <div class="space-x-5">
                                <span>
                                    <strong>{{props.postsCount}}</strong> posts
                                </span>

                                <span>
                                    <strong>{{props.followersCount}}</strong> followers
                                </span>

                                <span>
                                    <strong>{{props.followingCount}}</strong> following
                                </span>
                            </div>

                        </div>
                        <div v-if="props.canEditProfile" class="whitespace-nowrap hidden sm:block">
                            <Link :href="route('post.create')"
                                class="px-8 py-2 text-white font-noraml bg-blue-500 hover:bg-blue-600 rounded-md">
                            Create Post </Link>
                        </div>

                    </div>

                    <div>
                        <p><strong>{{props.profile.title ?? ''}}</strong></p>
                        <p class="text-sm">{{props.profile.description ?? ''}}</p>


                        <a :href="props.profile.url ?? '#'" target="_blank"
                            class="underline-none hover:underline text-blue-500"> {{props.profile.url_text ?? ''}}</a>
                    </div>

                </div>

            </div>

            <div class="px-48 my-6">
                <hr>
            </div>

            <!-- gallery section  -->
            <div class="text-center text-4xl mb-8 ">
                <span
                    class="after:content-[''] after:block after:mx-auto after:bg-cyan-500 after:w-28 after:rounded-lg after:h-1 after:mt-2 ">
                    Profile Posts
                </span>
            </div>
            <div class='grid grid-cols-1 md:grid-cols-3 gap-3 '>

                <div v-for="post in posts" :key="post.id" class="max-w-full overflow-hidden">
                    <div class="relative">
                        <img class="w-full h-80 object-cover object-center rounded transition duration-150 ease-in-out hover:scale-110 hover:cursor-pointer -0.5"
                            :src="'/storage/'+ post.image" loading="lazy">
                        <div class="hover:cursor-pointer absolute hover:bg-gray-900/50  bottom-0 left-0 right-0 top-0 transition-all duration-500"
                            @click="previewImage(post)">
                            <div class="flex text-white justify-center items-center h-full space-x-4">
                                <div class="flex space-x-3"><img :src="props.assetUrlProfile + '/' + 'small-comment.svg'"
                                        class="w-6" /> <span class="font-semibold"> {{post.comments.length}}</span></div>
                                <div class="flex space-x-3"><img :src="props.assetUrlProfile + '/' + 'small-heart.svg'"
                                        class="w-6" /> <span class="font-semibold"> {{post.likes.length}}</span></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </AppLayout>


    <div v-if="show">
        <Teleport to="body">
            <ProfileImageModelVue :post="postInfo" :can="canEditProfile" :assetUrl="assetUrl" @cancel-preview="show = !show" />
        </Teleport>
    </div>

</template>

<style>
    * {
        box-sizing: border-box;
    }

</style>

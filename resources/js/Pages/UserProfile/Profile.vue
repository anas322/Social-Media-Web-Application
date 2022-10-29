<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue';
    import ProfileImageModelVue from '@/Components/Profile/ProfileImageModel.vue';
    import {
        ref
    } from 'vue';
    import {
        Link
    } from "@inertiajs/inertia-vue3";

    const props = defineProps({
        profile: Object,
        posts: Object
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
                    <div class="overflow-hidden w-48 h-auto" style="border-radius:50%">
                        <img src="https://images.pexels.com/photos/415829/pexels-photo-415829.jpeg" alt="image profile"
                            loading="lazy">
                    </div>
                </div>

                <div class="md:col-span-9 mt-8 pl-8">

                    <div class="mb-6 flex justify-between">
                        <div>
                            <div class="flex space-x-8 ">
                                <h1 class="font-bold text-2xl pb-2 capitalize">{{$page.props.user.name}}</h1>
                                <div>
                                    <Link :href="route('prof.edit',$page.props.user)" class="px-4 py-1 text-gray-900 font-semibold ring-1 ring-slate-600  transition rounded-lg">Edit</Link>
                                </div>
                            </div>

                            <div class="space-x-5">
                                <span>
                                    <strong>{{props.posts.length}}</strong> posts
                                </span>

                                <span>
                                    <strong>135</strong> followers
                                </span>

                                <span>
                                    <strong>135</strong> following
                                </span>
                            </div>

                        </div>
                        <div class="whitespace-nowrap hidden sm:block">
                            <Link :href="route('post.create')"
                                class="px-8 py-2 text-white font-semibold bg-blue-500 hover:bg-blue-600 rounded-full">
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
                    <img class="w-full h-80 object-cover object-center rounded transition duration-150 ease-in-out hover:scale-110 hover:cursor-pointer -0.5"
                        :src="'/storage/'+ post.image" loading="lazy" @click="previewImage(post)">
                </div>

            </div>
        </div>
    </AppLayout>


    <div v-if="show">
        <Teleport to="body">
            <ProfileImageModelVue :post="postInfo" @cancel-preview="show = !show" />
        </Teleport>
    </div>

</template>

<style>
    * {
        box-sizing: border-box;
    }

</style>

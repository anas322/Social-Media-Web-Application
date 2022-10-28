<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue';

    import {
        Head,
        Link
    } from "@inertiajs/inertia-vue3";

    const props = defineProps({
        user: Object,
        profile:Object
    });
    console.log(props.profile);
    

</script>

<template>

    <Head title="Welcome" />
    <AppLayout title="Dashboard">
        <div class="container mx-auto w-11/12 md:w-5/6 py-12 min-h-screen   ">
            <!-- header section -->
            <div class="grid grid-cols-12 ">

                <div class="col-span-3">
                    <img class="w-6/12 h-auto mx-auto" style="border-radius:50%"
                        src="https://images.pexels.com/photos/415829/pexels-photo-415829.jpeg" alt="image profile"
                        loading="lazy">
                </div>

                <div class="col-span-9 ">

                    <div class="mb-6">
                        <h1 class="font-bold text-2xl pb-2 capitalize">{{props.user.name}}</h1>

                        <div class="space-x-5">
                            <span>
                                <strong>135</strong> posts
                            </span>

                            <span>
                                <strong>135</strong> followers
                            </span>

                            <span>
                                <strong>135</strong> following
                            </span>
                        </div>

                    </div>

                    <div>
                        <p><strong>{{props.profile.title}}</strong></p>
                        <p class="text-sm">{{props.profile.description}}</p>


                        <Link :href="props.profile.profile_url" class="underline-none hover:underline text-blue-500">freecodecamp.org</Link>
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
                <div class="max-w-full overflow-hidden">
                    <img class="w-full rounded transition duration-150 ease-in-out hover:scale-110 hover:cursor-pointer -0.5"
                        src="https://cdn.pixabay.com/photo/2015/12/01/20/28/road-1072823__340.jpg">
                </div>
                <div class="max-w-full overflow-hidden">
                    <img class="w-full rounded transition duration-150 ease-in-out hover:scale-110 hover:cursor-pointer -0.5"
                        src="https://cdn.pixabay.com/photo/2015/12/01/20/28/road-1072823__340.jpg">
                </div>

                <div class="max-w-full overflow-hidden">
                    <img class="w-full rounded transition duration-150 ease-in-out hover:scale-110 hover:cursor-pointer -0.5"
                        src="https://cdn.pixabay.com/photo/2015/12/01/20/28/road-1072823__340.jpg">
                </div>

                <div class="max-w-full overflow-hidden">
                    <img class="w-full rounded transition duration-150 ease-in-out hover:scale-110 hover:cursor-pointer -0.5"
                        src="https://cdn.pixabay.com/photo/2015/12/01/20/28/road-1072823__340.jpg">
                </div>

                <div class="max-w-full overflow-hidden">
                    <img class="w-full rounded transition duration-150 ease-in-out hover:scale-110 hover:cursor-pointer -0.5"
                        src="https://cdn.pixabay.com/photo/2015/12/01/20/28/road-1072823__340.jpg">
                </div>
                <div class="max-w-full overflow-hidden">
                    <img class="w-full rounded transition duration-150 ease-in-out hover:scale-110 hover:cursor-pointer -0.5"
                        src="https://cdn.pixabay.com/photo/2015/12/01/20/28/road-1072823__340.jpg">
                </div>
                <div class="max-w-full overflow-hidden">
                    <img class="w-full rounded transition duration-150 ease-in-out hover:scale-110 hover:cursor-pointer -0.5"
                        src="https://cdn.pixabay.com/photo/2015/12/01/20/28/road-1072823__340.jpg">
                </div>
                <div class="max-w-full overflow-hidden">
                    <img class="w-full rounded transition duration-150 ease-in-out hover:scale-110 hover:cursor-pointer -0.5"
                        src="https://cdn.pixabay.com/photo/2015/12/01/20/28/road-1072823__340.jpg">
                </div>


            </div>
        </div>
    </AppLayout>

</template>

<style>
    * {
        box-sizing: border-box;
    }

</style>

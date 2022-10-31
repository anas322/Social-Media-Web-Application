<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue';
    const props = defineProps({
        posts: Object,
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
                                <img src="https://ui-avatars.com/api/?name=John+Doe" style="clip-path:circle()">
                            </div>
                            <textarea class="w-full focus:ring-0 resize-none align-center rounded-full border-none h-10"  placeholder="What's in your mind?"></textarea>
                            <button type="submit" class="h-auto text-white bg-indigo-600 rounded-full text-lg px-8 py-2">Post</button>
                        </div>
                     </form>   
                </div>

                <!-- posts  -->
                <div v-for="x in 2" :key="x" class="bg-white rounded-2xl">
                    <article class="space-y-4 p-4">
                        <!-- header part  -->
                        <div class="flex space-x-4">
                            <div>
                                <img src="https://ui-avatars.com/api/?name=John+Doe" style="clip-path:circle()" class="w-14">
                            </div>

                            <div>
                                <p><strong>Lana Rose</strong></p>
                                <small class="text-gray-500 font-semibold">Dubai 15 street ADD</small>
                            </div>
                        </div>

                        <!-- picture  -->
                        <div>
                            <img src="https://as1.ftcdn.net/v2/jpg/05/17/62/04/1000_F_517620437_cYWS3KfueSCVsEh8EYAxUGyNwOFcAMUH.jpg" class="rounded-xl w-full">
                        </div>
                        
                        <!-- caption  -->
                        <div>
                            <p class="text-sm text-gray-600 font-semibold"> <strong class="text-base text-black">Lana Rose</strong> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore omnis, aperiam maxime harum rem sit molestias, accusantium maiores delectus aliquam consectetur incidunt, itaque et odio. Repellat sapiente voluptas vero doloribus.</p>
                        </div>
                    </article>
                </div>
            </div>

            <!-- side right  -->
            <aside class="bg-slate-300 col-span-3 rounded-2xl"></aside>
        </section>
    </AppLayout>

</template>

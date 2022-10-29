<script setup>
    import {
        useForm
    } from '@inertiajs/inertia-vue3';

    import AppLayout from '@/Layouts/AppLayout.vue';

    const props  = defineProps({
        url:String,
        profile:Object
    })  

    const form = useForm('EditUser', {
        title:props.profile.title,
        description:props.profile.description,
        url:props.profile.url,
        url_text:props.profile.url_text
    })




</script>

<template>

    <AppLayout title="Add New Post">
        <div class=" container mx-auto w-11/12 md:w-5/6 min-h-screen mt-16">

            <span
                class="after:content-[''] after:block after:mx-auto after:bg-cyan-500 after:w-28 after:rounded-lg after:h-1 after:mt-2 ">
                <span class="capitalize text-center text-4xl font-bold block">
                    edit your profile
                </span>
            </span>

            <div class="flex justify-center ">
                <div class=" w-2/4 mx-auto bg-slate-200 rounded-lg p-8 mt-8 ">     
                    <form class="mt-16 space-y-4" @submit.prevent="  form.post(props.url,form)">
                        <div class="space-y-2">
                            <span class="block capitalize font-semibold text-lg">title :</span>
                           <input type="text" v-model="form.title" class="rounded-md w-full border-none" placeholder="title..." >
                           <span v-if="form.errors.title" class="text-sm text-red-600 block p-1 ">{{form.errors.title}}
                        </span>
                        </div>
    
                        <div class="space-y-2">
                            <span class="block capitalize font-semibold text-lg">description :</span>
                           <input type="text" v-model="form.description" class="rounded-md w-full border-none" placeholder="description..." >
                            <span v-if="form.errors.description" class="text-sm text-red-600 block p-1 ">{{form.errors.description}}
                        </span>
                        </div>

                        <div class="space-y-2">
                            <span class="block capitalize font-semibold text-lg">URL Text :</span>
                           <input type="text" v-model="form.url_text" class="rounded-md w-full border-none" placeholder="URL text..." >
                            <span v-if="form.errors.url_text" class="text-sm text-red-600 block p-1 ">{{form.errors.url_text}}
                        </span>
                        </div>
                        
                        <div class="space-y-2">
                            <span class="block capitalize font-semibold text-lg">URL :</span>
                           <input type="text" v-model="form.url" class="rounded-md w-full border-none" placeholder="URL..." >
                            <span v-if="form.errors.url" class="text-sm text-red-600 block p-1 ">{{form.errors.url}}
                        </span>
                        </div>


                        <div class="float-right">
                            <button type="submit"
                                class="px-8 py-2 text-white font-semibold bg-blue-500 hover:bg-blue-600 rounded-full disabled:bg-gray-400"
                                :disabled="form.processing">Edit</button>
                        </div>
                    </form>
                </div>

            </div>

        </div>
    </AppLayout>

</template>

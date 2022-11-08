<script setup>
    import {
        useForm
    } from '@inertiajs/inertia-vue3';
    import {ref } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue';

    const url = ref(null)

    const form = useForm('createUser', {
        caption: '',
        image: null
    })

    const previewImage = (e)=>{
        const file = e.target.files[0];
        url.value = URL.createObjectURL(file);
    }

    const deleteImage = (e) =>{
        e.stopPropagation();
        e.target.files = null
        url.value = null
    }

</script>

<template>

    <AppLayout title="Add New Post">
        <div class=" container mx-auto w-11/12 md:w-5/6 min-h-screen mt-16">

            <span
                class="after:content-[''] after:block after:mx-auto after:bg-cyan-500 after:w-28 after:rounded-lg after:h-1 after:mt-2 ">
                <span class="capitalize text-center text-4xl font-bold block">
                    add new post
                </span>
            </span>

            <div class="flex justify-center ">
                
                <form class="mt-16 space-y-4" @submit.prevent="form.post('/p',form)">
                    <div class=" md:block">
                        <textarea
                            class=" w-full md:w-12/12  border-gray-300  rounded-md bg-gray-50 text-lg resize-none focus-within:border-none"
                            cols="60" rows="3" v-model="form.caption" placeholder="Caption..."></textarea>
                        <span v-if="form.errors.caption" class="text-sm text-red-600 block p-1 ">{{form.errors.caption}}
                        </span>
                    </div>

                    <div class="flex justify-center items-center w-full">
                        <label for="dropzone-file" class="relative flex flex-col justify-center items-center w-full h-[31rem] bg-gray-50 rounded-lg border-2 border-gray-300 border-dashed cursor-pointer dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                            <div class="flex flex-col justify-center items-center pt-5 pb-6">
                                <svg aria-hidden="true" class="mb-3 w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                                <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span></p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG ,JPEG</p>
                            </div>
                            <input id="dropzone-file" @input="form.image = $event.target.files[0]"  @change="previewImage" type="file" class="hidden" />
                                <div class="w-full h-full absolute right-0 top-0 bottom-0 left-0 rounded-lg overflow-hidden">
                                    <img :src="url" v-if="url" class="w-full h-full object-cover rounded-lg" >
                                </div>

                            <span v-if="url" @click="deleteImage" class="absolute right-4 top-2 text-lg hover:cursor-pointer py-1 px-2 rounded-lg transition duration-700 font-bold text-white bg-gray-500/70 ">X</span>
                        </label>
                    </div> 

                    <span v-if="form.errors.image"
                            class="text-sm text-red-600 block p-1">{{form.errors.image}}</span>
                    <div class="float-right">
                        
                        <button type="submit"
                            class="px-8 py-2 text-white font-semibold bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br hover:bg-blue-600 rounded-full disabled:bg-gray-400"
                            :disabled="form.processing">Post</button>
                    </div>
                </form>

            </div>

        </div>
    </AppLayout>

</template>

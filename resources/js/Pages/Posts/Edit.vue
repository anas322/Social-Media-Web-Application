<script setup>
    import {
        useForm
    } from '@inertiajs/inertia-vue3';
    import {ref } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue';

    const props = defineProps({
        post:Object,
        imageUrl:String,
        editUrl:String,
    })
  
    const url = ref(null)
    
    url.value = props.imageUrl;

    const form = useForm('UpdatePost', {
        caption: props.post.caption,
        image: null
    })
    console.log(props.errors, form);
      const previewImage = (e)=>{
        const file = e.target.files[0];
        url.value = URL.createObjectURL(file);
    }

</script>

<template>

    <AppLayout title="Add New Post">
        <div class=" container mx-auto w-11/12 md:w-5/6 min-h-screen mt-16">

            <span
                class="after:content-[''] after:block after:mx-auto after:bg-cyan-500 after:w-28 after:rounded-lg after:h-1 after:mt-2 ">
                <span class="capitalize text-center text-4xl font-bold block">
                    Edit post
                </span>
            </span>

            <div class="flex justify-center ">

                <form class="mt-16 space-y-4" @submit.prevent="form.post(props.editUrl,form)">
                    <div class=" md:block">
                        <textarea 
                            class="w-full md:w-12/12  border-gray-300  rounded-md bg-gray-50 text-lg resize-none focus-within:border-none" cols="60" rows="3"
                             v-model="form.caption" placeholder="Caption..."></textarea>
                        <span v-if="form.errors.caption" class="text-sm text-red-600 block p-1 ">{{form.errors.caption}}
                        </span>
                    </div>

                    <div class="relative">
                        <input type="file" @input="form.image = $event.target.files[0]" @change="previewImage"
                            class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-violet-100 file:text-violet-700 hover:file:bg-violet-200 file:hover:cursor-pointer" />
                        <span v-if="form.errors.image"
                            class="text-sm text-red-600 block p-1">{{form.errors.image}}</span>

                        <div class="w-16 h-10 absolute right-0 top-0 rounded-lg overflow-hidden">
                            <img :src="url" v-if="url" class="w-full object-cover rounded-lg" >
                        </div>
                    </div>

                    <div class="float-right">
                        <button type="submit"
                            class="px-8 py-2 text-white font-semibold bg-blue-500 hover:bg-blue-600 rounded-full disabled:bg-gray-400"
                            :disabled="form.processing">Edit</button>
                    </div>
                </form>

            </div>

        </div>
    </AppLayout>

</template>

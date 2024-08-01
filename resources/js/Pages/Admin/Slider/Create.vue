<script setup>
import { Link, useForm } from "@inertiajs/vue3";
import { Head } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/Admin/AdminLayout.vue";

const form = useForm({
slider_name:'',
slider_description:'',
image:null,
});

defineProps({
errors:Object,
});

const submit = () =>{
    form.post(route('slider.store'));
}
</script>

<template>
 <AdminLayout>
    <Head title="Slider-Create" />
    <h2 class="text-xl text-blue-700 leading-tight text-center"> Add Slider Page</h2>
    
    

    <div class="w-full pb-5">
      <Link :href="route('admin.slider')"
        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
       Back
      </Link>
    </div>

    <div class="p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
      <div class="relative overflow-x-auto">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <form @submit.prevent="submit" class="max-w-lg mx-auto">
                    
                    <!-- slider name  -->
                    <div class="mb-5">
                        <label for="slider_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Slider Name</label>
                        <input type="text" id="slider_name" v-model="form.slider_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write slider name"/>
                        <div class="text-red-400 text-sm" v-if="errors && errors.slider_name">{{ errors.slider_name }}</div>
                    </div>
                    <div class="mb-5">
                        <label for="slider_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Slider Description</label>
                        <input type="text" id="slider_description" v-model="form.slider_description" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write slider description"/>
                        <div class="text-red-400 text-sm" v-if="errors && errors.slider_description">{{ errors.slider_description }}</div>
                    </div>
                    
                    <div class="mb-5">
                        <label for="image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Image Upload</label>
                        <input type="file" id="image" @input="form.image = $event.target.files[0]" class="bg-white-50 border border-gray-50 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"/>
                    </div>
                    

                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Submit
                    </button>
                </form>
        </div>
      </div>
    </div>
  </AdminLayout>
    
</template>
<style scoped>

</style>

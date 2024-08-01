<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";
import { ref } from 'vue';
import axios from 'axios';
import AdminLayout from "@/Layouts/Admin/AdminLayout.vue";

 

defineProps({
    errors: Object,
    categories: Array,
    subcategories: Array,
    users: Array,
});

const form = useForm({
    category_id: '',
    subcategory_id: '',
    product_name: '',
    price: '',
    description: '',
    product_image: null,
   
});

// const addImage = (event) => {
//     const files = event.target.files;
//     if (files) {
//         for (let i = 0; i < files.length; i++) {
//             form.slider_image.push(files[i]);
//             const reader = new FileReader();
//             reader.onload = (e) => {
//                 form.slider_image_previews.push(e.target.result);
//             };
//             reader.readAsDataURL(files[i]);
//         }
//     }
// };

// const removeImage = (index) => {
//     form.slider_image.splice(index, 1);
//     form.slider_image_previews.splice(index, 1);
// };

const submit = async () => {
    try {
        await form.post(route('product.store'));
    } catch (error) {
        if (axios.isCancel(error)) {
            console.error('Request canceled', error.message);
        } else {
            console.error('An error occurred:', error.message);
        }
    }
};
</script>

<template>
    <AdminLayout>
 
    <Head title="Product Create" />
    <h2 class="text-xl text-blue-700 leading-tight text-center">
            Add Product
        </h2>
        <div class="w-full pb-5">
            <Link :href="route('admin.products')" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-6 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                Back
            </Link>
        </div>

        <div class="p-6 w-3/4 m-auto  bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <form @submit.prevent="submit" class="space-y-6 col-center">
              
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- category select -->
                    <div>
                        <label for="category_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                        <select v-model="form.category_id" id="category_id" class="mt-1 block w-full pl-3 pr-10 py-2 border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                            <option v-for="category in categories" :key="category.id" :value="category.id">{{ category.category_name }}</option>
                        </select>
                        <div class="text-red-400 text-sm" v-if="errors.category_id">{{ errors.category_id }}</div>
                    </div>

                    <!-- subcategory select -->
                    <div>
                        <label for="subcategory_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sub Category</label>
                        <select v-model="form.subcategory_id" id="subcategory_id" class="mt-1 block w-full pl-3 pr-10 py-2 border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                            <option v-for="subcategory in subcategories" :key="subcategory.id" :value="subcategory.id">{{ subcategory.subcategory_name }}</option>
                        </select>
                    </div>
                    <!-- product name -->
                    <div>
                        <label for="product_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product Name</label>
                        <input type="text" id="product_name" v-model="form.product_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Product Name"/>
                        <div class="text-red-400 text-sm" v-if="errors.product_name">{{ errors.product_name }}</div>
                    </div>

                    <!-- price -->
                    <div>
                        <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price</label>
                        <input type="text" id="price" v-model="form.price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Price"/>
                        <div class="text-red-400 text-sm" v-if="errors.price">{{ errors.price }}</div>
                    </div>


                    <!-- description -->
                    <div>
                        <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                        <textarea id="description" v-model="form.description" rows="3" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Product Description"></textarea>
                        <div class="text-red-400 text-sm" v-if="errors.description">{{ errors.description }}</div>
                    </div>
        

                </div>

                <!-- Product image -->
                <div>
                    <label for="product_image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product Image</label>
                    <input type="file" id="product_image" @change="e => form.product_image = e.target.files[0]" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                    <div class="text-red-400 text-sm" v-if="errors.product_image">{{ errors.product_image }}</div>
                </div>

                <!-- featured video -->
                <!-- <div>
                    <label for="featured_video" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Featured Video</label>
                    <input type="file" id="featured_video" @change="e => form.featured_video = e.target.files[0]" accept="video/mp4, video/webm"  class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                    <div class="text-red-400 text-sm" v-if="errors.featured_video">{{ errors.featured_video }}</div>
                </div> -->

          

                <div class="flex items-center justify-end mt-4">
                    <button type="submit" class="ml-4 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </AdminLayout>
</template>

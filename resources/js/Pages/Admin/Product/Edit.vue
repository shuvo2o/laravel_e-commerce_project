<script setup>
import { Head, Link, useForm, router } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/Admin/AdminLayout.vue";


const props = defineProps({
    product: Object,
    categories: Array,
    subcategories: Array,
});



const form = useForm({
    category_id: props.product?.category_id || '',
    subcategory_id: props.product?.subcategory_id || '',
    product_name: props.product?.product_name || '',
    description: props.product?.description || '',
    product_image:null,
    featured_video: null,
});


// mcd  const submit = () => {
//     router.post(`/admin/products/update/${props.product.id}`, {
//         _method: "put",
//         category_id: props.product?.category_id ?? '',
//         subcategory_id: props.product?.subcategory_id ?? '',
//         product_name: props.product?.product_name ?? '',
//         description: props.product?.description ?? '',
//         product_image: null,
//         featured_video: null,
//     });
// };

const submit = () => {
    router.post(route('product.update', props.product.id), {
        _method: "put",
        category_id: form.category_id,
        subcategory_id: form.subcategory_id,
        product_name: form.product_name,
        description: form.description,
        image: form.image,
        product_video: form.product_video,
    });
}

</script>


<template>
    <AdminLayout>

        <Head title="Product Edit" />
        <h2 class="text-xl text-blue-700 leading-tight text-center">
            Edit Product
        </h2>
        <div class="w-full pb-5">
            <Link :href="route('admin.products')"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-6 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
            Back
            </Link>
        </div>

        <div class="p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <form @submit.prevent="submit" class="space-y-6">

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- category select -->
                    <div>
                        <label for="category_id"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                        <select v-model="form.category_id" id="category_id"
                            class="mt-1 block w-full pl-3 pr-10 py-2 border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                            <option v-for="category in categories" :key="category.id" :value="category.id">{{
                                category.category_name }}</option>
                        </select>
                    </div>

                    <!-- subcategory select -->
                    <div>
                        <label for="subcategory_id"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sub Category</label>
                        <select v-model="form.subcategory_id" id="subcategory_id"
                            class="mt-1 block w-full pl-3 pr-10 py-2 border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                            <option v-for="subcategory in subcategories" :key="subcategory.id" :value="subcategory.id">
                                {{ subcategory.subcategory_name }}</option>
                        </select>
                    </div>

                    <!-- product name -->
                    <div>
                        <label for="product_name"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product Name</label>
                        <input type="text" id="product_name" v-model="form.product_name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Product Name" />
                    </div>

                    <!-- description -->
                    <div>
                        <label for="description"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                        <textarea id="description" v-model="form.description" rows="3"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Product Description"></textarea>

                    </div>
                </div>

                <!-- product image -->
                <div>
                    <label for="product_image"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product Image</label>
                    <input type="file" id="product_image" @change="e => form.product_image = e.target.files[0]"
                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">


                    <div v-if="props.product.product_image" class="mt-2 mb-3">
                        <img :src="`/${props.product.product_image}`" alt="Image"
                            class="w-20 h-20 object-cover rounded-lg border border-gray-300" />
                    </div>
                </div>

                <!-- featured video -->
                <div>
                    <label for="featured_video" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Featured Video</label>
                    <input type="file" id="featured_video" @change="e => form.featured_video = e.target.files[0]"
                        accept="video/mp4, video/webm"
                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">

                    <div v-if="props.product.featured_video" class="mt-2 mb-3">
                        <video class="h-40 w-40 object-cover rounded-sm border border-blue-300 p-2" controls>
                            <source :src="`/${product.featured_video}`" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>

                </div>
                <div class="flex items-center justify-end mt-4">
                    <button type="submit"
                        class="ml-4 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </AdminLayout>
</template>



<style></style>
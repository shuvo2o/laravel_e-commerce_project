<script setup>
import { Link, router } from "@inertiajs/vue3";
import { Head } from "@inertiajs/vue3";
import Swal from 'sweetalert2'
import AdminLayout from "@/Layouts/Admin/AdminLayout.vue";

defineProps({
    products: Object,
});

const deleteProduct =(id) => {
  Swal.fire({
    title: "Are you sure?",
    text: "You won't be able to revert this!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, delete it!"
  }).then((result) => {
    if (result.isConfirmed) {
      router.delete(route('product.delete', id), {
        onFinish: () => {
          Swal.fire({
            title: "Deleted!",
            text: "Your file has been deleted.",
            icon: "success"
          });
        }
      });
    }
  });
}
</script>

<template>
<AdminLayout>

        <Head title="Products" />
        <h2 class="text-xl text-blue-700 leading-tight text-center"> Products Page</h2>
        <!-- <div v-if="$page.props.flash.message" class="alert text-green-500 text-end">
          {{ $page.props.flash.message }}
         </div> -->

        <div class="w-full pb-5">
            <Link :href="route('product.create')"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
            Add Product
            </Link>
        </div>

        <div class="p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <div class="relative overflow-x-auto">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-blue-700 uppercase bg-gray-300 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">Serial</th>
                                <th scope="col" class="">Category</th>
                                <th scope="col" class="">SubCategory</th>
                                <th scope="col" class="">Product Name</th>
                                <th scope="col" class=""> Description</th>
                                <th scope="col" class=""> Product Image</th>
                                <th scope="col" class="">Featured Video</th>
                                <th scope="col" class="px-7 py-4">Edit</th>
                                <th scope="col" class="px-7 py-4">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="products in products" :key="products.id"
                                class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ products.id }} </th>
                                <td class="px-2 py-1"> {{ products?.category_id}}</td>
                                <td class="px-2 py-1"> {{ products?.subcategory_id}}</td>
                                <td class="px-2 py-1"> {{ products.product_name }}</td>
                                <td class="px-2 py-1"> {{ products.description }}</td>
                                <td class="">
                                    <img :src="`/${products.product_image}`" :alt="image"
                                        class="h-12 w-12 object-cover rounded-full border border-blue-300 p-2" />
                                </td>
                                <td class="px-2 py-1">
                                    <video class="h-20 w-20 object-cover rounded-sm border border-blue-300 p-2"
                                    controls>
                                        <source :src="`/${products.featured_video}`" type="video/mp4" >
                                    </video>
                                </td>
                                <!-- <td class=" py-7 flex justify-center items-center gap-3">
                  <Link :href="route('products.edit', products.id)" class="font-medium text-green-600 dark:text-green-700 hover:underline title" title="Edit"><i class="fa-regular fa-pen-to-square"></i></Link>
                  <button @click="deleteProduct(products.id)" class="font-medium text-red-600 dark:text-red-500 hover:underline" title="Delete"><i class="fa-solid fa-trash"></i></button> 
                  
                </td> -->
                                       <td class="px-7 py-4">
                                    <Link :href="route('product.edit', products.id)" class="font-medium text-green-600 dark:text-green-700 hover:underline">Edit</Link>
                                  </td>
                  
                                  <td class="px-6 py-4">
                                    <button @click="deleteProduct(products.id)" class="font-medium text-red-600 dark:text-red-500 hover:underline">Delete</button>
                                  </td>


                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        
                <!-- Pagination -->
<!-- 
                <div class="flex items-center justify-start gap-3 mt-4">
                  <button 
                    @click="router.get(products.prev_page_url)" 
                    :disabled="!products.prev_page_url"
                    class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 disabled:opacity-50"
                  >
                    &larr; Previous
                  </button>
        
                  <span class="px-4 py-2">
                    Page {{ products.current_page }} of {{ products.last_page }}
                  </span>
        
                  <button 
                    @click="router.get(products.next_page_url)" 
                    :disabled="!products.next_page_url"
                    class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 disabled:opacity-50"
                  >
                    Next &rarr;
                  </button>
                </div>  -->



    </AdminLayout>
   
</template>

<style></style>
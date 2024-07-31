<!-- UserLayout.vue -->
<script setup>
import { onMounted } from 'vue';
import { initFlowbite } from 'flowbite';
import Header from './Header.vue';
import Footer from './Footer.vue';
import Hero from './Hero.vue';

// Initialize components based on data attribute selectors
onMounted(() => {
    initFlowbite();
});

const products = [
    {
        id: 1,
        name: 'Basic Tee',
        href: '#',
        imageSrc: 'https://tailwindui.com/img/ecommerce-images/product-page-01-related-product-01.jpg',
        imageAlt: "Front of men's Basic Tee in black.",
        price: '$35',
        color: 'Black',
    },
    {
        id: 2,
        name: 'Basic Tee',
        href: '#',
        imageSrc: 'https://tailwindui.com/img/ecommerce-images/product-page-01-related-product-01.jpg',
        imageAlt: "Front of men's Basic Tee in black.",
        price: '$35',
        color: 'Black',
    }
];
</script>

<template>
    <!-- Header Start -->
    <Header></Header>
    <!-- Header End -->

    <!-- Hero Start -->
    <Hero></Hero>
    <!-- Hero End -->

    <!-- Main Content Start -->
    <slot :products="products"/>
    <!-- Main Content End -->

    <!-- Footer Start -->
    <Footer></Footer>
    <!-- Footer End -->
</template>

<style></style>

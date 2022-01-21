<template>
    <div class="container p-4"> 
        <carousel :slides="products" :interval="3000" controls />
    </div>
</template>
 
<script>
    import Carousel from './components/carousel/Carousel.vue';

    export default {
        name: 'App',
        components: {
            Carousel
        },
        data() {
            return {
                products: [],
                loading: true,
                errored: false
            }
        },
        mounted() {
            axios
                .get('http://localhost/api/products')
                .then(response => {
                    this.products = response.data.products
                })
                .catch(error => {
                    console.log(error)
                    this.errored = true;
                })
                .finally(() => this.loading = false);
        }
    }
</script>
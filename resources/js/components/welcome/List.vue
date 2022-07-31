<template>
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <div class="col mb-5" v-for="product in products" :key="product.id">
                    <Card :product="product" btn_link="#"></Card>
                </div>
            </div>
        </div>
    </section>

</template>

<script>
import Card from './Card.vue'
export default {
    components: { Card },
    data() {
        return {
        errors: [],
        products:[],
        };
    },
    created(){
        this.fetchProducts();
    },
    methods: {
        fetchProducts() {
            axios.get('products/json').then((response) => {
                this.products = response.data;
            });
        },
    } 
}
</script>
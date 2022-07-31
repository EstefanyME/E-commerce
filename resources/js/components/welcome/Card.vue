<template>
    <div class="card h-100">
        <!-- Sale badge-->
        <div v-if="sale" class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale
        </div>
        <!-- Product image-->
        <img class="card-img-top mt-4" style="height: 150px;object-fit:scale-down;" :src="product.url_image" :alt="product.name" />
        <!-- Product details-->
        <div class="card-body p-4">
            <div class="text-center">
                <!-- Product name-->
                <h4 class="text-center">{{ product.brand.name }}</h4>
                <h5 class="fw-bolder">{{ product.name }}</h5>
                <span> {{ product.description }}</span><br>
                <!-- Product reviews-->
                <div v-if="stars>0" class="d-flex justify-content-center small text-warning mb-2">
                    <i class="fa-solid fa-star" v-for="n in stars" :key="n"></i>
                </div>
                <!-- Product price-->
                <!--<span class="text-muted text-decoration-line-through">{{ old_price }}</span>-->
                <h3 class="mt-4">{{ product.price | money }}</h3>                
            </div>
        </div>
        <!-- Product actions-->
        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
            <div class="text-center"><button class="btn btn-outline-dark mt-auto" @click="addToCart()">Agregar al carrito</button>
            </div>
        </div>
    </div>

</template>

<script>
import accounting from 'accounting';
export default {
    props: ['product', 'stars', 'sale'],
    methods:{
        addToCart(){
            console.log('Agregando producto '+this.product.name+' al carrito');
            var payload ={
                id :this.product.id,
                name: this.product.name,
                price: this.product.price,
                quantity:1,
            };
            axios
                .post("cart/add", payload)
                .then((response) => {
                    this.loading = false;
                    swal.fire("!Agregado!", response.data.message, "success");
                })
                .catch((error) => {
                    this.errors = error.response.data.errors;
                    this.loading = false;
                });
        }
    },
    filters:{
        money(val){
            return accounting.formatMoney(val);
        }
    }
}
</script>
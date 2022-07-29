<template>
  <div>
    <div class="modal-body">
      <div class="row">
        <div class="col-12 col-md-6">
          <div class="form-group">
            <label for="title">Marca<span style="color: #ff0000">*</span></label
            >
            <select
              class="form-control"
              v-model="item.brand_id">
              <option value="" disabled selected>SELECCIONA MARCA</option>
              <option :value="brand.id" v-for="brand in brands">{{ brand.name }}</option>
              </select>
            <span v-for="error in errors.brand_id" :key="error.brand_id">
              <small class="text-danger">{{ error }}</small>
            </span>
          </div>
        </div>
        <div class="col-12 col-md-6">
          <div class="form-group">
            <label for="title"
              >Categoria<span style="color: #ff0000">*</span></label
            >
             <select
              class="form-control"
              v-model="item.category_id">
              <option value="" disabled selected>SELECCIONA CATEGORIA</option>
              <option :value="category.id" v-for="category in categories" :key="category.id">{{category.name}}</option>
              </select>
            <span v-for="error in errors.category_id" :key="error.category_id">
              <small class="text-danger">{{ error }}</small>
            </span>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12 col-md-3">
          <div class="form-group">
            <label for="title"
              >Código de barras<span style="color: #ff0000">*</span></label
            >
            <input
              type="text"
              dusk="barcode"
              class="form-control"
              v-model="item.barcode"
            />
            <span v-for="error in errors.barcode" :key="error.barcode">
              <small class="text-danger">{{ error }}</small>
            </span>
          </div>
        </div>
        <div class="col-12 col-md-9">
          <div class="form-group">
            <label for="title"
              >Nombre<span style="color: #ff0000">*</span></label
            >
            <input
              type="text"
              dusk="name"
              class="form-control"
              v-model="item.name"
            />
            <span v-for="error in errors.name" :key="error.name">
              <small class="text-danger">{{ error }}</small>
            </span>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="form-group">
            <label for="title"
              >Descripción</label
            >
            <textarea
              cols="1"
              rows="5"
              class="form-control"
              v-model="item.description"
            ></textarea>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12 col-md-3">
          <div class="form-group">
            <label for="title"
              >Precio<span style="color: #ff0000">*</span></label
            >
            <input
              type="number"
              dusk="price"
              class="form-control"
              v-model="item.price"
            />
            <span v-for="error in errors.price" :key="error.price">
              <small class="text-danger">{{ error }}</small>
            </span>
          </div>
        </div>
        <div class="col-12 col-md-3">
          <div class="form-group">
            <label for="title"
              >Existencias<span style="color: #ff0000">*</span></label
            >
            <input
              type="number"
              dusk="stock"
              class="form-control"
              v-model="item.stock"
            />
            <span v-for="error in errors.stock" :key="error.stock">
              <small class="text-danger">{{ error }}</small>
            </span>
          </div>
        </div>
        <div class="col-12 col-md-3">
          <div class="form-group">
            <label for="title"
              >Url Imagen</label
            >
            <input
              type="text"
              dusk="url_image"
              class="form-control text-lowercase"
              v-model="item.url_image"
            />
            <span v-for="error in errors.url_image" :key="error.url_image">
              <small class="text-danger">{{ error }}</small>
            </span>
          </div>
        </div>
      </div>
    </div>

    <div class="modal-footer">
      <button
        type="button"
        class="btn btn-secondary"
        @click="onClose()"
        :disabled="loading"
      >
        Cancelar
      </button>
      <button
        type="button"
        dusk="guardarUser"
        class="btn btn-primary"
        @click="submitItem()"
        :disabled="loading"
      >
        Guardar <i v-show="loading" class="fa fa-spinner fa-spin"></i>
      </button>
    </div>
  </div>
</template>

<script>
import Multiselect from "vue-multiselect";
export default {
  props: ["item"],
  components: { Multiselect },
  data() {
    return {
      errors: [],
      categories:[],
      brands:[],
      loading: false,
      allCategoriesChecked: false,
    };
  },
  created(){
    this.fetchBrands();
    this.fetchCategories();
  },
  methods: {
    fetchBrands(){
      axios.get('brands/json').then((response) =>{
        this.brands = response.data;
      });
    },
    fetchCategories(){
      axios.get('categories/json').then((response) =>{
        this.categories = response.data;
      });
    },
    submitItem() {
      if (this.loading === true) {
        return;
      }
      this.loading = true;
      var input = this.item;

      if (this.item.action == 1) {
        axios
          .post("products", input)
          .then((response) => {
            this.$emit("fetch-data");
            this.$emit("close");
            this.errors = [];
            this.loading = false;
            swal.fire("!Guardado!", response.data.message, "success");
          })
          .catch((error) => {
            this.errors = error.response.data.errors;
            this.loading = false;
          });
      } else if (this.item.action == 2) {
        axios
          .put("products/" + this.item.id, input)
          .then((response) => {
            this.$emit("fetch-data");
            this.$emit("close");
            this.errors = [];
            this.loading = false;
            swal.fire("!Modificado!", response.data.message, "success");
          })
          .catch((error) => {
            this.errors = error.response.data.errors;
            this.loading = false;
          });
      }
    },
    onClose() {
      this.errors = [];
      this.$emit("close");
    },
  },
};
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>

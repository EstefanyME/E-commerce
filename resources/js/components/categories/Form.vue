<template>
  <div>
    <div class="modal-body">
      <div class="row">
      <div class="col-12">
        <div class="form-group">
            <label for="title">Categoría Padre</label>
            <select class="form-control" v-model="item.parent_id">
              <option value="">SIN CATEGORÍA PADRE</option>
              <option :value="category.id" v-for="category in categories" :key="category.id">{{ category.name }}</option>
            </select>
          </div>
      </div>

    </div>
      <div class="row">
        <div class="col-12 col-md-8">
          <div class="form-group">
            <label for="title"
              >Nombre<span style="color: #ff0000">*</span></label
            >
            <input
              type="text"
              dusk="nombre"
              class="form-control"
              v-model="item.name"
            />
            <span v-for="error in errors.name" :key="error.name">
              <small class="text-danger">{{ error }}</small>
            </span>
          </div>
        </div>
        <div class="col-12 col-md-2">
          <div class="form-group">
            <label for="title"
              >Orden</label
            >
            <input
              type="text"
              class="form-control text-lowercase"
              v-model="item.order"
            />
            <span v-for="error in errors.order" :key="error.order">
              <small class="text-danger">{{ error }}</small>
            </span>
          </div>
        </div>
        <div class="col-12 col-md-2">
          <div class="form-group">
            <label for="title"
              >Nivel</label
            >
            <input
              type="text"
              class="form-control text-lowercase"
              v-model="item.nivel"
            />
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="form-group">
            <label for="title"
              >Url Imagen</label
            >
            <input
              type="text"
              dusk="url"
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
        dusk="guardarCategory"
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
import axios from "axios";
import Multiselect from "vue-multiselect";
export default {
  props: ["item"],
  components: { Multiselect },
  data() {
    return {
      errors: [],
      loading: false,
      allCategoriesChecked: false,
      categories:[]
    };
  },
  created(){
    this.fetchCategories();
  },
  methods: {
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
          .post("categories", input)
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
          .put("categories/" + this.item.id, input)
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

<template>
  <div>
    <div class="modal-body">
      <div class="row">
        <div class="col-12">
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
      </div>
      <div class="row">
        <div class="col-xs-12 col-sm-7 col-md-7">
          <div class="form-group">
            <label for="title"
              >Correo electrónico<span style="color: #ff0000">*</span></label
            >
            <input
              type="email"
              dusk="email"
              class="form-control text-lowercase"
              v-model="item.email"
            />
            <span v-for="error in errors.email" :key="error.email">
              <small class="text-danger">{{ error }}</small>
            </span>
          </div>
        </div>
        <div class="col-xs-12 col-sm-5 col-md-5">
          <div class="form-group">
            <label for="title"
              >Contraseña<span style="color: #ff0000">*</span></label
            >
            <input
              type="password"
              class="form-control text-lowercase"
              v-model="item.password"
            />
            <span v-for="error in errors.password" :key="error.password">
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
      loading: false,
      allCategoriesChecked: false,
    };
  },
  methods: {
    submitItem() {
      if (this.loading === true) {
        return;
      }
      this.loading = true;
      var input = this.item;

      if (this.item.action == 1) {
        axios
          .post("users", input)
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
          .put("users/" + this.item.id, input)
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

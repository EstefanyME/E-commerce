<template>
  <div class="row mt-2 mb-2">
    <div class="col-xs-6 col-md-3 mb-1">
        <span>Mostrar </span>
        <select @change="onPerPageChange">
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="50">50</option>
            <option value="100">100</option>
            <option value="200">200</option>
            <option value="500">500</option>
        </select>
        <span> Registros</span>
    </div>
    <div class="col-xs-6 offset-md-4 col-md-5 mb-1">
      <div class="input-group">
        <input dusk="buscarE" type="text" v-model="filterText" class="form-control form-control-sm" @keyup.enter="doFilter" placeholder="Introduce un texto para buscar...">
        <div class="input-group-append">
          <button class="btn btn-outline-secondary btn-sm" @click="resetFilter">
            <i class="fas fa-eraser"></i>
          </button>
          <button dusk="search" class="btn btn-primary btn-sm" @click="doFilter">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data () {
    return {
      filterText: '',
      per_page: 10
    }
  },
  methods: {
    doFilter () {
      this.$events.fire('filter-set', this.filterText)
    },
    resetFilter () {
      this.filterText = ''  // clear the text in text input
      this.$events.fire('filter-reset')
    },
    onPerPageChange (e){
      this.per_page = Number(e.target.value);
      this.$events.fire('per-page-set', this.per_page);
    }
  }
}
</script>

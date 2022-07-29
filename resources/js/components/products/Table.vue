<template>
<div>
    <filter-bar></filter-bar>
    <div class="table-responsive">
        <vuetable ref="vuetable" api-url="/ecommerce/public/products" :fields="fields" :sort-order="sortOrder" :css="css.table" pagination-path="" :per-page="per_page" :append-params="moreParams" @vuetable:pagination-data="onPaginationData" @vuetable:loading="onLoading" @vuetable:loaded="onLoaded">
         <template slot="image" slot-scope="props">
            <a :href="props.rowData.url_image" target="_blank">
                <img :src="props.rowData.url_image" alt="Imagen" style="max-height:32px">
            </a>
         </template>
            <template slot="actions" slot-scope="props">
                <div class="text-center align-middle actions mx-auto" style="width:150px;">                 
                    <button class="btn btn-warning btn-sm"
                        v-if="!props.rowData.deleted_at"
                        @click.prevent="$emit('update-item',props.rowData)" data-toggle="tooltip" title="Editar Registro">
                        <i class="fas fa-pencil-alt"></i>
                    </button>
                    <button class="btn btn-danger btn-sm"
                        v-if="!props.rowData.deleted_at"
                        @click.prevent="$emit('delete-item',props.rowData)"
                        data-toggle="tooltip" title="Eliminar registro">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </template>
      </vuetable>
    </div>
    <div class="row paginate">
        <div class="col-md-6">
            <vuetable-pagination-info ref="paginationInfo" info-template="Mostrando del {from} al {to} de un total de {total} registros">
            </vuetable-pagination-info>
        </div>
        <div class="col-md-6 text-right">
            <vuetable-pagination ref="pagination" :css="css.pagination" @vuetable-pagination:change-page="onChangePage">
            </vuetable-pagination>
        </div>
    </div>
</div>
</template>

<script>
import {Vuetable, VuetablePagination, VuetablePaginationInfo} from "vuetable-2";
import FilterBar from "../partials/FilterBar.vue";
import TableCssConfig from "../../config/bs4table";
import moment from 'moment';
export default {
    components: {
        Vuetable,
        VuetablePagination,
        VuetablePaginationInfo,
        FilterBar
    },
    data() {
        return {
            fields: [
                {
                    name:'id',
                    title:'ID',
                    sortField:'id',
                    titleClass: 'text-center',
                    dataClass: 'text-center align-middle',
                },
                {
                    name:'brand.name',
                    title:'ID Marca',
                    titleClass: 'text-center',
                    sortField:'brand_id',
                    dataClass:'fw-bolder'
                },
                {
                    name:'category.name',
                    title:'ID Categoría',
                    titleClass: 'text-center',
                    sortField:'category_id',
                    dataClass:'fw-bolder'
                },
                {
                    name:'barcode',
                    title:'Codigo de Barras'
                },
                {
                    name:'name',
                    title:'Nombre',
                     titleClass: 'text-center',
                    dataClass: 'align-middle',
                },
                {
                    name:'description',
                    title:'Descripción',
                     titleClass: 'text-center',
                    dataClass: 'align-middle',
                },
                {
                    name:'price',
                    title:'Precio',
                     titleClass: 'text-center',
                    dataClass: 'align-middle',
                },
                {
                    name:'stock',
                    title:'Existencias',
                     titleClass: 'text-center',
                    dataClass: 'align-middle',
                },
                {
                    name: '__slot:image',
                    title: 'Imagen',
                    titleClass: 'text-center',
                    dataClass: 'text-center align-middle',
                },               
                {
                    name: '__slot:actions',
                    title: 'Acciones',
                    titleClass: 'text-center',
                    dataClass: 'text-center align-middle',
                }
            ],
            sortOrder: [{
                field: 'id',
                direction: 'desc'
            }],
            moreParams: {
                'query': ''
            },
            per_page: 10,
            css: TableCssConfig,
        }
    },
    mounted() {
        this.$events.$on('filter-set', eventData => this.onFilterSet(eventData))
        this.$events.$on('filter-reset', e => this.onFilterReset())
        this.$events.$on('per-page-set', eventData => this.onPerPageChange(eventData))
    },
    methods: {
        onPaginationData(paginationData) {
            this.$refs.pagination.setPaginationData(paginationData)
            this.$refs.paginationInfo.setPaginationData(paginationData)
        },
        onChangePage(page) {
            this.$refs.vuetable.changePage(page)
        },
        editRow(rowData) {
            alert("You clicked edit on" + JSON.stringify(rowData))
        },
        deleteRow(rowData) {
            alert("You clicked delete on" + JSON.stringify(rowData))
        },
        onLoading() {
            //console.log('loading... show your spinner here')
            this.$events.fire('set-loading', true);
        },
        onLoaded() {
            //console.log('loaded! .. hide your spinner here')
            this.$events.fire('set-loading', false);
        },
        formatDate(value) {
            if (value != null)
                return moment(value).format('DD/MM/YYYY');
            return ''
        },
        nombreLabel(value) {
            return '';
        },
        activoLabel(value) {
            return value == null ?
                '<span class="badge badge-success">Activo</span>' :
                '<span class="badge badge-danger">Inactivo</span>'
        },
        onFilterSet(filterText) {
            this.moreParams = {
                'query': filterText
            }
            Vue.nextTick(() => this.$refs.vuetable.refresh())
        },
        onFilterReset() {
            this.moreParams = {
                'query': ''
            }
            Vue.nextTick(() => this.$refs.vuetable.refresh())
        },
        onPerPageChange(perPage) {
            this.per_page = perPage;
            Vue.nextTick(() => this.$refs.vuetable.refresh())
        }
    }
};
</script>

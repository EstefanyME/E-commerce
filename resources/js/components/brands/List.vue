<template>
    <div>
        <div class="row">
            <div class="col-md-9 mt-2">
                <h4><i class="fa-solid fa-copyright"></i> <b>Marcas</b>
                <i v-show="loading" class="fa fa-spinner fa-spin"></i>
                </h4>
            </div>
            <div class="col-md-3 text-right pl-1">    
                <a class="btn btn-success"
                    href="/branchs/export">
                    <i class="fas fa-file-excel"></i>
                </a>               
                <button dusk="newBranch" class="btn btn-primary w-75"
                    @click.prevent="createItem()">
                    Nueva Marca
                </button>                
            </div>
        </div>
        <hr class="mt-0">

        <!-- Users Table -->
        <table-server
            @update-item="updateItem($event)"
            @delete-item="deleteItem($event)"
            @verify-item="verifyItem($event)"
            @authorize-item="authorizeItem($event)">
        </table-server>


        <!-- Modal -->
        <modal :title="modal.title" :isLarge="true" v-if="modal.show" @close="modal.show = false">
            <modal-form
                @close="modal.show = false"
                @fetch-data="$children[0].$refs.vuetable.reload()"
                :item="item">
            </modal-form>
        </modal>

    </div>
</template>

<script>
    import Table from './Table';
    import Modal from '../partials/Modal';
    import Form from './Form';
    export default {
        components: {
            'table-server' : Table,
            'modal'        : Modal,
            'modal-form'   : Form
        },
        data(){
            return {
                item:{
                    id: '',
                    name: '',
                    url_logo: '',
                    action: 1
                },
                modal: {
                    title: '',
                    show: false
                },
                loading: false,
            }
        },
        created(){
            this.$events.$on('set-loading', eventData => this.onLoadingSet(eventData))
        },
        methods: {
            createItem(){
                this.item.id = null;
                this.item.name = '';
                this.item.url_logo = '';
                this.item.action = 1;
                this.modal.title = 'Nueva marca'
                this.modal.show = true;
            },
            updateItem(item) {
                this.item.id = item.id;
                this.item.name = item.name;
                this.item.url_logo = item.url_logo;
                this.item.action = 2;
                this.modal.title = 'Editar marca'
                this.modal.show = true;
            },
            deleteItem(item){
                swal.fire({
                  title: '¿Estás seguro?',
                  text: "¡Este proceso eliminará la marca del sistema!",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: '¡Sí, eliminarlo!',
                  cancelButtonText: 'Cancelar',
                }).then((result) =>  {
                    if (result.value) {
                        this.loading = true;
                        axios.delete('brands/' + item.id).then(response => {
                            this.$children[0].$refs.vuetable.reload();
                            swal.fire('!Eliminado!',response.data.message, 'success');
                            this.loading = false;
                        })
                        .catch(error => {
                            this.loading = false;
                            swal.fire('!Error!','Su registro no se pudo eliminar', 'error');                            
                        });
                    }
                });
            },
            onLoadingSet(status){
                this.loading = status;
            }
        }
    }
</script>

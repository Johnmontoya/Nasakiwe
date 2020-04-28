<template>
    <div class="row justify-content-center">
        <div class="col-md-12">         
            <div class="card">
                <div class="card-header">
                    <h4 class="modal-title" v-text="tituloModal"></h4>
                </div>
                <div class="card-body">
                    <div class="modal-body needs-validation" novalidate>

                        <div class="row">
                            <div class="form-group col-md-3">      
                                    <label>Rol</label>
                                    <input type="text" v-model="nombre" placeholder="Ingrese Nombre de Rol" class="form-control" required>
                            </div>         
                            
                        </div>                      

                            <button type="button" class="btn btn-primary" v-if="tipoAccion==1" @click="registrarRol()">Guardar</button>
                            <button type="button" class="btn btn-info" v-if="tipoAccion==2" @click="actualizarRol()">Actualizar</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal" v-if="tipoAccion==2" @click="cerrarModal()">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Registro Roles</h4>
                </div>
                                
                <div class="card-body">
                    <table id="example1" class="table table-striped table-hover table-responsive">
                        <thead class=" text-dark">
                            <th>Nombre</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </thead>
                        <tbody>
                            <tr v-for="rol in arrayRol" :key="rol.id">
                                <td v-text="rol.nombre"></td>
                                <td>
                                    <div v-if="rol.condicion">
                                        <span class="label label-success">Activo</span>
                                    </div>
                                    <div v-else>
                                        <span class="label label-danger">Desactivado</span>
                                    </div>
                                </td>
                            <td class="td-actions text-center">
                                <template v-if="rol.condicion">
                                    <button type="button" class="btn btn-danger btn-sm" title="cambiar estado" @click="desactivarRol(rol.id)">
                                        <i class="pe-7s-refresh-2"></i>
                                    </button>
                                </template>
                                <template v-else>
                                    <button type="button" class="btn btn-success btn-sm" title="cambiar estado" @click="activarRol(rol.id)">
                                        <i class="pe-7s-refresh-2"></i>
                                    </button>
                                </template>
                                
                                <button type="button" @click="abrirModal('rol','actualizar',rol)" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-default" title="Editar">
                                    <i class="pe-7s-pen"></i>
                                </button>
                            </td>
                            </tr>
                        </tbody>
                    </table>
                    </div>
                    <nav class="mt-2" aria-label="...">
                        <ul class="pagination">
                            <li class="page-item" v-if="pagination.current_page > 1">
                            <a class="page-link" href="#" tabindex="-1" @click.prevent="cambiarPagina(pagination.current_page - 1, buscar, criterio)">Anterior</a>
                            </li>
                            <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active':'']">
                                <a class="page-link" href="#" @click.prevent="cambiarPagina(page, buscar, criterio)" v-text="page"></a>
                            </li>
                            <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                            <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1, buscar, criterio)">Siguiente</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
</template>

<script>
    export default {
        data(){
            return {
                rol_id: 0,
                nombre: '',
                condicion: 0,
                arrayRol: [],
                modal: 0,
                tituloModal: 'Registrar Rol',
                tipoAccion: 1,
                pagination:{
                    'total': 0,
                    'current_page': 0,
                    'per_page': 0,
                    'last_page': 0,
                    'from': 0,
                    'to': 0,
                },
                offset: 3,
                criterio: 'nombre',
                buscar: '',
            }
        },
        computed:{
            isActived: function(){
                return this.pagination.current_page;
            },
            pagesNumber: function(){
                if(!this.pagination.to){
                    return [];
                }
                var from = this.pagination.current_page - this.offset;
                if(from < 1){
                    from = 1;
                }

                var to = from + (this.offset * 2);
                if(to >= this.pagination.last_page){
                    to = this.pagination.last_page;
                }

                var pagesArray = [];
                while(from <= to){
                    pagesArray.push(from);
                    from++;
                }

                return pagesArray;
            }
        },
        methods:{        
            listarRol(page, buscar, criterio){
                let me = this;
                var url = '/rol?page=' + page + '&buscar=' + buscar + '&criterio=' + criterio;
                axios.get(url).then(function(response){
                    var respuesta = response.data;
                    me.arrayRol = respuesta.roles.data;
                    me.pagination = respuesta.pagination;
                })
                .catch(function(error){
                    console.log(error)
                });
            },
            cambiarPagina(page, buscar, criterio){
                let me = this;
                me.pagination.current_page = page;
                me.listarRol(page, buscar, criterio);
            },
            activarRol(id){
                swal({
                title: 'Esta seguro de activar este rol?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar!',
                cancelButtonText: 'Cancelar',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    let me = this;

                    axios.put('/rol/activar',{
                        'id': id
                    }).then(function (response) {
                        me.listarRol(1,'','nombre');
                        swal(
                        'Activado!',
                        'El rol ha sido activado con éxito.',
                        'success'
                        )
                    }).catch(function (error) {
                        console.log(error);
                    });
                    
                    
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    
                }
                })
            },
            desactivarRol(id){
                swal({
                title: 'Esta seguro de desactivar este rol?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar!',
                cancelButtonText: 'Cancelar',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    let me = this;

                    axios.put('/rol/desactivar',{
                        'id': id
                    }).then(function (response) {
                        me.listarRol(1,'','nombre');
                        swal(
                        'Desactivado!',
                        'El rol ha sido desactivado con éxito.',
                        'success'
                        )
                    }).catch(function (error) {
                        console.log(error);
                    });
                    
                    
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    
                }
                })
            },
            registrarRol(){
                let me = this;
                axios.post('/rol/registrar', {
                    'nombre': this.nombre                  
                }).then(function(response){
                    me.cerrarModal();
                    me.listarRol(1,'','nombre');
                })
                .catch(function(error){
                    
                });
                swal('Activado!', 'El Rol ha sido guardado con éxito.', 'success');
            },
            actualizarRol(){
                let me = this;
                axios.put('/rol/actualizar', {
                    'nombre': this.nombre,
                    'id': this.rol_id
                }).then(function(response){
                    me.cerrarModal();
                    me.listarRol(1,'', 'nombre');
                })
                .catch(function(error){
                    
                });
                swal('Activado!', 'El Rol ha sido actualizado con éxito.', 'success');
            },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='Registrar Rol';
                this.tipoAccion=1;
                this.nombre='';
            },
            abrirModal(modelo, accion, data = []){
                switch(modelo){
                    case "rol":{
                        switch(accion){
                            case "actualizar":{
                                this.tipoAccion = 2,
                                this.modal = 1,
                                this.tituloModal = 'Actualizar Rol',
                                this.rol_id = data['id'],
                                this.nombre = data['nombre'];
                                break;
                            }
                        }
                    }
                }
            }
        },
        mounted() {
            this.listarRol(1, this.buscar, this.criterio);
        }
    }
</script>
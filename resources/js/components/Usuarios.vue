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
                            <label>Cédula</label>                              
                                <input type="text" name="cedula" v-model="cedula" v-validate="'numeric'" placeholder="Ingrese Documento" :class="{'form-control': true, 'is-danger': errors.has('cedula') }">                                    
                                <div v-show="errorUser" class="alert alert-danger" role="alert">
                                    <span v-for="error in errorMostrarMsjDocumento" :key="error" v-text="error"></span>
                                    <br>
                                    <span v-show="errors.has('cedula')" class="help is-danger">{{ errors.first('cedula') }}</span>
                                </div>
                            </div>          
                        <div class="form-group col-md-4">
                            <label>Nombre</label>
                            <input type="text" v-model="nombre" placeholder="Ingrese Nombre" class="form-control">                          
                            <div v-show="errorUser" class="alert alert-danger" role="alert">
                                <span v-for="error in errorMostrarMsjNombre" :key="error" v-text="error"></span>
                            </div>                            
                        </div>

                        <div class="form-group col-md-4">
                            <label>Apellido</label>
                            <input type="text" v-model="apellido" placeholder="Ingrese Apellido" class="form-control">    
                            <div v-show="errorUser" class="alert alert-danger" role="alert">
                                <span v-for="error in errorMostrarMsjApellido" :key="error" v-text="error"></span>
                            </div>                                
                        </div>  
                    </div>

                    <div class="row">
                        <div class="form-group col-md-5">
                            <label>Rol</label>
                            <select v-model="id_rol" class="form-control">
                                <option value="0" disabled>Seleccione:</option>
                                <option v-for="rol in arrayRol" :key="rol.id" :value="rol.id" v-text="rol.nombre"></option>
                            </select>
                            <div v-show="errorUser" class="alert alert-danger" role="alert">
                                <span v-for="error in errorMostrarMsjRol" :key="error" v-text="error"></span>
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Correo Electrónico</label>
                            <input type="text" name="email" v-model="correo" v-validate.initial="'email'" :class="{'form-control': true, 'is-danger': errors.has('email') }" placeholder="Ingrese Email" />   
                            <div v-show="errorUser" class="alert alert-danger" role="alert">
                                <span v-for="error in errorMostrarMsjCorreo" :key="error" v-text="error"></span>
                                <br>
                                <div v-show="errors.has('email')" class="help is-danger">{{ errors.first('email') }}</div>                                    
                            </div>
                        </div> 
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Usuario</label>
                            <input type="text" v-model="usuario" class="form-control" placeholder="Ingrese Nombre de Usuario"> 
                            <div v-show="errorUser" class="alert alert-danger" role="alert">
                                <span v-for="error in errorMostrarMsjUsername" :key="error" v-text="error"></span>
                            </div>
                        </div>

                        <div class="form-group col-md-5">
                            <label>Contraseña</label>
                            <input type="password" v-model="password" class="form-control" placeholder="Ingrese Contraseña">
                            <div v-show="errorUser" class="alert alert-danger" role="alert">
                                <span v-for="error in errorMostrarMsjPassword" :key="error" v-text="error"></span>
                            </div>
                        </div>
                    </div>

                        <button type="button" class="btn btn-primary" v-if="tipoAccion==1" @click="registrarUser()">Guardar</button>
                        <button type="button" class="btn btn-info" v-if="tipoAccion==2" @click="actualizarUser()">Actualizar</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal" v-if="tipoAccion==2" @click="cerrarModal()">Cancelar</button>
                  </div>
              </div>
          </div>
      </div>

      
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Usuarios</h4>
                </div>

                <div class="card-body">
                <table id="example1" class="table table-striped table-hover table-responsive">
                    <thead class=" text-dark">
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Cédula</th>
                        <th>Correo</th>
                        <th>Usuario</th>
                        <th>Rol</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </thead>
                    <tbody>
                        <tr v-for="user in arrayUser" :key="user.id">
                        <td v-text="user.nombre"></td>
                        <td v-text="user.apellido"></td>
                        <td v-text="user.cedula"></td>
                        <td v-text="user.email"></td>
                        <td v-text="user.name"></td>
                        <td v-text="user.rol"></td>
                        <td>
                            <div v-if="user.estado">
                                <span class="label label-success">Activo</span>
                            </div>
                            <div v-else>
                                <span class="label label-danger">Desactivado</span>
                            </div>
                        </td>
                        <td class="td-actions text-center">
                                <template v-if="user.estado">
                                    <button type="button" class="btn btn-sm btn-danger" title="cambiar estado" @click="desactivarUser(user.id)">
                                        <i class="pe-7s-refresh-2"></i>
                                    </button>
                                </template>
                                <template v-else>
                                    <button type="button" class="btn btn-sm btn-success" title="cambiar estado" @click="activarUser(user.id)">
                                        <i class="pe-7s-refresh-2"></i>
                                    </button>
                                </template>
                                
                                <button type="button" @click="abrirModal('user','actualizar',user)" class="btn btn-sm btn-primary" title="Editar">
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
        data (){
            return {
                id: 0,
                user_id: 0,
                nombre: '',
                apellido: '',
                cedula: 0,
                correo: '',
                id_rol: 0,
                usuario: '',
                password: '',  
                arrayUser: [],
                arrayRol: [],
                pagination:{
                    'total': 0,
                    'current_page': 0,
                    'per_page': 0,
                    'last_page': 0,
                    'from': 0,
                    'to': 0,
                },
                offset: 3,
                criterio: 'cedula',
                buscar: '',
                modal: 0,
                tituloModal: 'Registrar Usuario',
                tipoAccion: 1,
                errorUser : 0,
                errorMostrarMsjUsername : [],
                errorMostrarMsjPassword : [],
                errorMostrarMsjRol : [],
                errorMostrarMsjNombre : [],
                errorMostrarMsjApellido : [],
                errorMostrarMsjDocumento : [],
                errorMostrarMsjCorreo: [],
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
            listarUser(page, buscar, criterio){
                let me = this;
                axios.get('/showUser').then(function(response){
                    var respuesta = response.data;
                    me.arrayUser = respuesta.users.data;
                })
                .catch(function(error){
                    console.log(error)
                });
            },
            cambiarPagina(page, buscar, criterio){
                let me = this;
                me.pagination.current_page = page;
                me.listarUser(page, buscar, criterio);
            },
            validarUser(){
                this.errorUser=0;
                this.errorMostrarMsjNombre = [];
                this.errorMostrarMsjApellido = [];
                this.errorMostrarMsjDocumento = [];                
                this.errorMostrarMsjRol = [];
                this.errorMostrarMsjCorreo= [];
                this.errorMostrarMsjUsername = [];
                this.errorMostrarMsjPassword = [];

                if (!this.nombre) this.errorMostrarMsjNombre.push("El nombre no puede estar vacío.");
                if (!this.apellido) this.errorMostrarMsjApellido.push("El apellido no puede estar vacío.");
                if (this.cedula == 0) this.errorMostrarMsjDocumento.push("El documento no puede estar vacio.");               
                if (this.id_rol == 0) this.errorMostrarMsjRol.push("Seleccione un Rol");
                if (!this.correo) this.errorMostrarMsjCorreo.push("El correo electrónico no puede estar vacío.");
                if(!this.usuario) this.errorMostrarMsjUsername.push("El campo usuario no debe estar vacio");
                if(!this.password) this.errorMostrarMsjPassword.push("El campo contraseña no debe estar vacio");

                if (this.errorMostrarMsjNombre.length) this.errorUser = 1;
                if (this.errorMostrarMsjApellido.length) this.errorUser = 1;
                if (this.errorMostrarMsjDocumento.length) this.errorUser = 1;
                if (this.errorMostrarMsjRol.length) this.errorUser = 1;
                if (this.errorMostrarMsjCorreo.length) this.errorUser = 1;
                if (this.errorMostrarMsjUsername.length) this.errorUser = 1;
                if (this.errorMostrarMsjPassword.length) this.errorUser = 1;

                return this.errorUser;
            },
            selectRol(){
                let me = this;
                var url = '/rol/selectRol';
                axios.get(url).then(function(response){
                    var respuesta = response.data;
                    me.arrayRol = respuesta.roles;
                })
                .catch(function(error){
                    console.log(error)
                });
            },
            registrarUser(){
                if (this.validarUser()){
                    return;
                }
                let me = this;
                axios.post('/user/registrar', {
                    'cedula': this.cedula,
                    'nombre': this.nombre,
                    'apellido': this.apellido,                    
                    'correo': this.correo,
                    'username': this.usuario,
                    'password': this.password,
                    'id_rol': this.id_rol
                }).then(function(response){
                    me.cerrarModal();
                    me.listarUser(1,'','nombre');
                    swal('Guardado!', 'El usuario ha sido guardada con éxito.', 'success');
                })
                .catch(function(error){
                    swal('Error!', 'Hubo un error al guardar el usuario.', 'error');
                });
                
            },
            actualizarUser(){
                if (this.validarUser()){
                    return;
                }
                let me = this;
                axios.put('/user/actualizar', {
                    'cedula': this.cedula,
                    'nombre': this.nombre,
                    'apellido': this.apellido,    
                    'correo': this.correo,
                    'username': this.usuario,
                    'password': this.password,
                    'id_rol': this.id_rol,
                    'id': this.user_id
                }).then(function(response){
                    me.cerrarModal();
                    me.listarUser(1,'', 'cedula');
                    swal('Activado!', 'El usuario ha sido actualizada con éxito.', 'success');
                })
                .catch(function(error){
                    swal('Error!', 'Hubo un error al actualizar el usuario.', 'error');
                });
            },
            activarUser(id){
                swal({
                title: 'Esta seguro de activar este usuario?',
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

                    axios.put('/user/activar',{
                        'id': id
                    }).then(function (response) {
                        me.listarUser(1,'','cedula');
                        swal(
                        'Activado!',
                        'El usuario ha sido activado con éxito.',
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
            desactivarUser(id){
                swal({
                title: 'Esta seguro de desactivar este usuario?',
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

                    axios.put('/user/desactivar',{
                        'id': id
                    }).then(function (response) {
                        me.listarUser(1,'','cedula');
                        swal(
                        'Desactivado!',
                        'El usuario ha sido desactivado con éxito.',
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
            cerrarModal(){
                this.modal=0;
                this.tituloModal='Registrar Usuario';
                this.tipoAccion=1;
                this.nombre='';
                this.cedula='';
                this.apellido = '';
                this.correo = '';                
                this.usuario='';
                this.password='';
                this.id_rol = 0;
            },
            abrirModal(modelo, accion, data = []){
                switch(modelo){
                    case "user":{
                        switch(accion){
                            case "actualizar":{
                                this.tipoAccion = 2,
                                this.tituloModal = 'Actualizar Usuario',
                                this.user_id = data['id'],
                                this.nombre = data['nombre'],
                                this.apellido = data['apellido'];
                                this.cedula = data['cedula'];
                                this.correo = data['email'],
                                this.usuario = data['name'],
                                this.id_rol = data['id_rol'];
                                break;
                            }
                        }
                    }
                }
            },
        },
        mounted() {
            this.selectRol();
            this.listarUser(1, this.buscar, this.criterio);
        }
    }
</script>

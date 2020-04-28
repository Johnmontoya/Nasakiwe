<template>
    <div class="row justify-content-center">
        <div class="col-md-4">         
            <div class="card">
                <div class="card-header">
                    <h4 class="modal-title" v-text="tituloModal"></h4>
                </div>
                <div class="card-body">
                    <div class="modal-body needs-validation" novalidate>
                        
                        <div class="row">
                            <div class="form-group col-md-12">      
                                <label>Indicadores</label>
                                <textarea v-model="indicador" placeholder="Ingrese el indicador" class="form-control" required></textarea>
                            </div> 
                        </div>

                        <div class="row"  style="padding-left:15px; padding-right:15px; margin-bottom:10px;">
                            <label>Peso</label>
                            <div class="input-group col-md-6">                             
                                <input type="text" v-model="peso" class="form-control" required>
                                <span class="input-group-addon" id="basic-addon2">%</span>
                            </div>   
                        </div>       

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="modal-body needs-validation" novalidate>
                        <div class="row">
                            <div class="form-group col-md-12">  
                                <label>Formula de Medición</label> 
                                <textarea v-model="medicion" placeholder="Ingrese la formula de medición" class="form-control" required></textarea>
                            </div>
                        </div>

                        <div class="row" style="padding-left:15px; padding-right:15px; margin-bottom:10px;">
                            <label>Valor</label>
                            <div class="input-group col-md-6">                             
                                <input v-model="pesoMedicion" class="form-control">
                                <span class="input-group-addon" id="basic-addon2">%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="modal-body needs-validation" novalidate>
                        <div class="row">
                            <div class="form-group col-md-12">  
                                <label>Periodicida de Reporte</label> 
                                <input type="text" v-model="periodo" placeholder="Ingrese la periodicida de reporte" class="form-control" required>
                            </div>
                        </div>

                        <label>Meta</label>
                        <div class="row" style="margin-bottom: 15px;">                            

                            <div class="col-md-4">
                                <select v-model="comparacion" class="form-control">
                                    <option value="0" disabled>Opt</option>
                                    <option value="1"> > </option>
                                    <option value="2"> >= </option>  
                                    <option value="3" v-text="menor"></option>  
                                    <option value="4" v-text="menorI"></option> 
                                    <option value="5">=</option>    
                               </select> 
                            </div>                            
                            
                            <div class="input-group col-md-6">                                                           
                                <input type="text" v-model="meta" class="form-control">
                                <span class="input-group-addon" id="basic-addon2">%</span>
                            </div>
                            
                        </div>

                        <button type="button" class="btn btn-primary" v-if="tipoAccion==1" @click="registrarIndicador()">Guardar</button>
                        <button type="button" class="btn btn-info" v-if="tipoAccion==2" @click="actualizarIndicador()">Actualizar</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal" v-if="tipoAccion==2" @click="cerrarModal()">Cancelar</button>
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data(){
        return {
            tituloModal: 'Registrar Reporte',
            indicador: '',
            peso: 0,
            medicion: '',
            pesoMedicion: 0,
            periodo: '',
            comparacion: '',
            meta: '',
            tipoAccion: 1,
            menor: '<',
            menorI: '<=',
        }
    },
    computed:{},
    methods:{
        registrarIndicador(){},
        actualizarIndicador(){},
        cerrarModal(){},
    },
    mounted(){

    }
}
</script>
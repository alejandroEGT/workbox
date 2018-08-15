<template>
	<div>
		<center v-loading="titleLoad"><h3>Proyecto//{{ proyecto.nombre }}</h3>
			({{proyecto.cliente}}), Estado:
			<div class="btn-group">
				  <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				    {{ proyecto.estado }}
				  </button>
				  <div class="dropdown-menu">
				    <button v-for="e in estado" class="dropdown-item btn btn-link"
				     @click="cambiar_estado_proyecto(e.id)">{{ e.estado }}</button>
				    
				  </div>
				</div>
		</center>
		<hr>
		<div class="row">
			<div class="col-md-2">
				
				<el-badge :value="count_col" class="item">
				  	<el-button icon="fa fa-users" size="small" data-toggle="modal" data-target="#exampleModal"> 
				  		Colaboradores
					</el-button>
				</el-badge>

				<!-- Modal -->
				<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  <div class="modal-dialog" role="document">
				    <div class="modal-content">
				      <div class="modal-header">
				        <h5 class="modal-title" id="exampleModalLabel">Colaboladores</h5>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>
				      <div class="modal-body">
				        	
						<div class="row">
							<div class="col-md-5">
								<el-select v-model="colaborador" filterable placeholder="Agrega colaborado">
								    <el-option
								      v-for="item in fil_colabo"
								      :key="item.id"
								      :label="item.nombres+' '+item.apellidos+' ('+ item.email +')'"
								      :value="item.id">
								    </el-option>
								</el-select>
							</div>
							<div class="col-md-2">
								<el-button type="success" @click="agregar_colaborador" icon="el-icon-check" circle></el-button>
							</div>
						</div>
						<hr>
						<table class="table table-responsive">
							<tr class="" >
								<td><strong>Colaborador</strong></td>
								<td><strong>Email</strong></td>
							</tr>
							<tr v-for="c in mis_colabo">
								<td>{{ c.nombres+" "+c.apellidos }}</td>
								<td>{{ c.email }}</td>
							</tr>
						</table>


				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				        <button type="button" class="btn btn-primary">Save changes</button>
				      </div>
				    </div>
				  </div>
				</div>
			</div>
			<div class="col-md-2">
				<el-button size="small" icon="far fa-calendar-alt" @click="click_cal"></el-button>
			</div>
		</div>
		<hr>


			<el-menu :default-active="activeIndex" class="el-menu-demo" mode="horizontal" >
  				<el-menu-item index="1">Tareas</el-menu-item>
  				<el-menu-item index="2">Mi flujo</el-menu-item>
  			</el-menu>

		<br>
		<div>
			<div class="row">
				<div class="col-md-3">
					<h3>Ingrese nueva tarea</h3>
					</el-input>
				</div>
			</div>

			<div class="row">
				<div class="col-md-2">
					<el-input v-model="tarea.nombre" size="medium" placeholder="Nombre de tarea" >
					</el-input>
				</div>
				<div class="col-md-4">
					<el-date-picker
						size="medium"
						v-model="tarea.fecha"
						type="daterange"
						format="dd/MM/yyyy"
						start-placeholder="Inicio"
						end-placeholder="Finalizacion"
						>
					</el-date-picker>
				</div>
				<div class="col-md-2">
					<el-input v-model="tarea.hora_estimada" size="medium" placeholder="Horas estimadas" >
					</el-input>
				</div>
				<div class="col-md-2">
					<el-select v-model="tarea.estado_tarea" >
						<el-option v-for=" e in est_tarea" 
						:label="e.estado"
						:value="e.id"
						:key="e.id"
						>
						</el-option>
					</el-select>
				</div>
				<div class="col-md-2">
					<el-button type="primary" icon="far fa-save" circle @click="creat_tarea"></el-button>
				</div>
			</div>
			<hr>
			<table v-if="tareas_if" class="table table-responsive">
			  <thead class="thead-dark">
			    <tr>
			      <th scope="col"><strong>COD</strong></th>
			      <th scope="col"><strong>Nombre</strong></th>
			      <th scope="col"><strong>Inica</strong></th>
			      <th scope="col"><strong>Finaliza</strong></th>
			      <th scope="col"><strong>Horas estimadas</strong></th>
			      <th scope="col"><strong>Estado</strong></th>
			      <th scope="col" colspan="2">Opciones</th>
			    </tr>
			  </thead>
			  <tbody>
			    <tr v-for="t in tareas" >
			      <th scope="row">{{ t.id }}</th>
			      <td>{{ t.nombre }}</td>
			      <td>{{ t.fecha_inicio }}</td>
			      <td>{{ t.fecha_fin }}</td>
			      <td>{{ t.horas_estimadas }}</td>
			      <td>{{ t.estado }}</td>
			      <td><el-button type="success" icon="far fa-eye" @click="click_view(t.id)" circle></el-button></td>
			      <td><el-button type="danger" icon="el-icon-delete" circle></el-button></td>
			    </tr>
			  </tbody>
			</table>
		</div>
	</div>
</template>

<script>
    
	import Autocomplete from 'vue2-autocomplete-js';
	export default{
		components: { Autocomplete },
		data(){
			return{
				id_proyecto: this.$route.params.id,
				proyecto:{},
				estado:{},
				count_col:'',
				tareas_if:false,
				tareas:{},
				fil_colabo:{},
				activeIndex: '1',	
				colaborador:'',
				mis_colabo:{},
				
				tarea:{
					id_proyecto: this.$route.params.id,
				},
				est_tarea:{},
				titleLoad:true,
				showDate: new Date(),
				localDataSource: [
		       
		        ]
	            
			}
		},
		created(){
			//kendo.culture("es-CL");
			this.traer_proyecto();
			this.traer_estados_tarea();
			this.traer_tareas();
			this.traer_todos_colaboradores();
			this.listar_mis_colaboradores();
		},
		methods:{
			traer_estados_tarea(){
				axios.get('api/estados_tarea').then((res)=>{
					this.est_tarea = res.data;
				});
			},
			traer_proyecto(){
				axios.get('api/proyecto/'+this.id_proyecto).then((res)=>{
					this.proyecto = res.data.p;
					this.estado = res.data.estados;
					console.log(this.estado)
					this.titleLoad = false;
				});
				this.contar_colabo();
				
			},
			contar_colabo(){
				axios.get('api/contar_colaborador/'+this.id_proyecto).then((res)=>{
					this.count_col = res.data;
				});
			},
			traer_tareas(){
				axios.get('api/get_tarea/'+this.id_proyecto).then((res)=>{
					if (res.data.estado == "success"){
						this.tareas_if = true;
						this.tareas = res.data.tareas;
						
					}
				});
			},
			creat_tarea(){
				console.log(this.tarea);
				axios.post('api/tarea',this.tarea).then((res)=>{
					this.traer_tareas();
				});
			},
			traer_todos_colaboradores(){
				axios.get('api/todos_colaboradores/'+this.id_proyecto).then((res)=>{
					this.fil_colabo = res.data
				});
			},
			listar_mis_colaboradores(){
				axios.get('api/mis_colaboradores/'+this.id_proyecto).then((res)=>{
					this.mis_colabo = res.data
				});	
			},
			agregar_colaborador(){
			
				axios.post('api/agregar_colaborador',{ 
					colaborador: this.colaborador,
					id_proyecto: this.id_proyecto
				}).then((res)=>{
					this.traer_todos_colaboradores();
					this.listar_mis_colaboradores();
					this.colaborador = null;
					this.contar_colabo();
				});	
			},
			cambiar_estado_proyecto($id_estado){
				const datos={
					id_estado: $id_estado,
					id_proyecto: this.id_proyecto
				};
				axios.post('api/cambiar_estado_proyecto', datos).then((res)=>{
						if (res.data == "success") {
							this.traer_proyecto();
						}
				});
			}
			,
			click_view($id_tarea){
				this.$router.push({ path:'/proyecto/tarea/'+this.id_proyecto+'/'+$id_tarea });
			},
			click_cal(){
				this.$router.push({ path:'/proyecto/calendario_tarea/'+this.id_proyecto });	
			},
			 getData(obj){
			
        console.log(obj);
      }
		},
		mounted(){
			//this.links = this.loadAll();
		}
	}
</script>
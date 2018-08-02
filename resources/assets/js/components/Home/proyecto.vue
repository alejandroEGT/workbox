<template>
	<div>
		<center v-loading="titleLoad"><h3>Proyecto//{{ proyecto.nombre }}</h3>
			({{proyecto.cliente}}), Estado: {{ proyecto.estado }}
		</center>
		<hr>
		<div class="row">
			<div class="col-md-2">
				Colaboradores: {{ count_col }}
			</div>
		</div>
		<hr>



			<el-menu :default-active="activeIndex" class="el-menu-demo" mode="horizontal" @select="handleSelect">
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
			<table v-if="tareas_if" class="table">
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
			      <td><el-button type="success" icon="far fa-eye" circle></el-button></td>
			      <td><el-button type="danger" icon="el-icon-delete" circle></el-button></td>
			    </tr>
			  </tbody>
			</table>
		</div>
	</div>
</template>

<script>
	export default{
		data(){
			return{
				id_proyecto: this.$route.params.id,
				proyecto:{},
				count_col:'',
				tareas_if:false,
				tareas:{},
				 activeIndex: '1',
				tarea:{
					id_proyecto: this.$route.params.id,
				},
				est_tarea:{},
				titleLoad:true
			}
		},
		created(){
			this.traer_proyecto();
			this.traer_estados_tarea();
			this.traer_tareas();
		},
		methods:{
			traer_estados_tarea(){
				axios.get('api/estados_tarea').then((res)=>{
					this.est_tarea = res.data;
				});
			},
			traer_proyecto(){
				axios.get('api/proyecto/'+this.id_proyecto).then((res)=>{
					this.proyecto = res.data;
					this.titleLoad = false;
				});

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
			}
		}
	}
</script>
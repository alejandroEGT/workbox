<template>
	<div>
		<center>
			<h3 style="color:#CACFD2">proyecto {{ perfil.proyecto }} </h3>
			<h4>Tarea//{{ perfil.tarea }}</h4>
		</center>
		
		<hr>
		
	</div>
</template>

<script>
	export default{
		data(){
			return{
				id_proyecto: this.$route.params.id_proyecto,
				id_tarea: this.$route.params.id_tarea,
				perfil:{},
				sino:true,
			}
		},
		created(){
			this.traer_perfil_tarea();
		},
		methods:{
			traer_perfil_tarea(){
				axios.get('api/get_perfil_tarea/'+this.id_proyecto+'/'+this.id_tarea).then((res)=>{
					this.perfil = res.data;
					console.log(this.perfil);
				});
			},
			// mostrar_perfil(){
			// 	axios.get("api/prueba").then((res)=>{
			// 		this.prueba = res.data;
			// 		this.sino = false;
			// 	});
			// }
		}

	}

</script>





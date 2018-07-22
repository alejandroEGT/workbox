<template>
	<div class="container">
		<br>
		<h3>Registro</h3>
		<div class="row justify-content-md-center">
			<div class="col-md-12">
				<el-form>
					<el-row :gutter="20">
						<el-col :span="12">
					      		<el-input icon="fa fa-user" placeholder="Nombres" v-model="form.nombres"></el-input>
					    </el-col>
					    <el-col :span="12">
								<el-input icon="fa fa-user" placeholder="Apellidos" v-model="form.apellidos"></el-input>
					    </el-col>
					</el-row>		
				<br>
					<el-form-item >
						<el-input icon="fab fa-odnoklassniki" placeholder="Nickname" v-model="form.nickname"></el-input>
					</el-form-item>
					<el-form-item>
						 <el-date-picker 
						  size="laarge"
					      v-model="form.nacimiento"
					      type="date"
					      format="dd-MM-yyyy"
					      range-separator="-"
					      placeholder="Fecha de nacimineto">
					    </el-date-picker>
					</el-form-item>

					<el-form-item>
						<el-radio-group v-model="form.sexo">
							  <el-radio :label="2">Hombre</el-radio>
							  <el-radio :label="1">Mujer</el-radio>
							</el-radio-group>
					</el-form-item>		

					<el-form-item >
						<el-input type="email" icon="fas fa-envelope" placeholder="Email" v-model="form.email"></el-input>
					</el-form-item>
					<el-form-item >
						<el-input type="password" icon="fas fa-key" placeholder="Clave" v-model="form.clave"></el-input>
					</el-form-item>
					 <el-button class="btn-block" @click="onSend" >Registrarme</el-button>
  
				</el-form>
			</div>	
		</div>
	</div>
</template>

<script type="text/javascript">
	export default{

		data(){
			return{
				form:{}
			}	
		},
		methods:{
			onSend(){
				//console.log(this.form);
				this.axios.post('/user', this.form).then((response) => {
				  console.log(response.data)
				})
			}
		}
	}
</script>
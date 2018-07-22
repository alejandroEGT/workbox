<template>
	<div class="container">
    <br>
      <h3>Log in</h3>
      <div class="row">
          <div class="col-md-12">
            <el-form ref="form" :model="form">
              <el-form-item >
                  <el-input
                    placeholder="Correo"
                    icon="fa fa-envelope-open"
                    v-model="form.email">
                  </el-input>

              </el-form-item>
              <el-form-item>
                  <el-input
                    type="password"
                    placeholder="Clave"
                    icon="fa fa-key"
                    v-model="form.password">
                  </el-input>
              </el-form-item>

              <el-button class="btn-block" @click="login">Log in</el-button>
            </el-form>
            <div class="row justify-content-md-center">
              <router-link :to="{name:'registro'}"class="nav-link">Crear una cuenta aqui</router-link>
            </div>  
          </div>
          
      </div>
	  
	</div>
</template>


<script>
  export default {
    data(){
      return{
        form:{},
      }
    },
    methods: {
      login(){
        var app = this
        this.$auth.login({
          data: app.form,
          redirect:'/index',
          success: function(){
            //this.$router.push({ path: '/index' });
          },
          error: function(){},
          rememberMe: true,
          //redirect: '/index',
          //fetchUser: true,
        });
      }
    }
  }
</script>

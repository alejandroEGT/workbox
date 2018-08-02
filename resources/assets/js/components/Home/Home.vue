<!--Master Page Home-->
<template>
  <div>
      <nav class="navbar navbar navbar-dark bg-dark fixed-top">
        <ul class="nav">
          <li class="nav-item">
            <!-- <img src="" style="float: left"> -->
            <label class="nav-link active" style="color:white">{{ user.nombres+' '+user.apellidos+'  | ' }}</label>
          </li>
          <li class="nav-item">
            <router-link style="color:white" :to="{path:'/index'}" class="nav-link active color">Home</router-link>
          </li>
          <li class="nav-item">
            <router-link style="color:white" :to="{name:'Chat'}"class="nav-link">Chat</router-link>
          </li>
          <li class="nav-item">
            <router-link style="color:white" :to="{name:'terminos'}" class="nav-link">otro</router-link>
          </li>
          <li class="nav-item">
            <button class="btn btn-link" @click="logout" >Salir</button>
          </li>
        </ul>	
      </nav>
<nav class="navbar-primary">
  <!-- <a href="#" class="btn-expand-collapse"><span class="glyphicon glyphicon-menu-left">kkck</span></a> -->
  <ul class="navbar-primary-menu">
    <li>
      <el-button style="margin-top:20px;" data-toggle="modal" data-target="#exampleModal" class="btn-block" icon="el-icon-edit" type="primary" round> Proyecto</el-button>
    </li>
    <li>
      <a href="#"><span class="glyphicon glyphicon-list-alt"></span><span class="nav-label">Dashboard</span></a>
      <a href="#"><span class="glyphicon glyphicon-envelope"></span><span class="nav-label">Profile</span></a>
      <a href="#"><span class="glyphicon glyphicon-cog"></span><span class="nav-label">Settings</span></a>
      <a href="#"><span class="glyphicon glyphicon-film"></span><span class="nav-label">Notification</span></a>
      <a href="#"><span class="glyphicon glyphicon-calendar"></span><span class="nav-label">Monitor</span></a>
    </li>
    <div  v-loading="loading" v-if="proyectos" >
   
      <div class="card" style=" background-color:black; height: 140px; overflow-x:scroll; overflow-y: scroll">
        <label style="margin-left:5px; color:white ">Proyectos:</label>
        <div v-for="p in proyectos">
            <router-link  :to="{path:'/proyecto/'+p.id}" style="margin-left:15px; margin-right:5px; color:white">{{ p.nombre }}</router-link>
        </div>
      </div>
    </div>
  </ul>
</nav>
  <div class="main-content">
     <router-view :key="$route.path"></router-view>  
  </div>



  <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Crear un nuevo proyecto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        <el-form>
          <el-form-item>
            <el-input
              placeholder="Nuevo proyecto"
              v-model="project.nombre">
              <i slot="prefix" class="fas fa-star"></i>
            </el-input>
          </el-form-item>

          <el-form-item>
            <el-input
              placeholder="Cliente"
              v-model="project.cliente">
              <i slot="prefix" class="fas fa-user"></i>
            </el-input>
          </el-form-item>
        </el-form>  

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" @click="crear_proyecto">Crear</button>
      </div>
    </div>
  </div>
</div>

</div>
</template>

<script type="text/javascript">
  export default{
    data(){
      return{
        project:{},
        proyectos:{},
        loading:true,
        user: this.$auth.user(), //$auth.user().nombres
      }
    },
    created(){
      $('.btn-expand-collapse').click(function(e) {
        $('.navbar-primary').toggleClass('collapsed');
      });

      this.traer_proyectos();
    },
    methods:{
      crear_proyecto(){
        axios.post('api/proyecto', this.project).then((res)=>{
            
            if (res.data == "success") {
              this.$message({
                message: 'Bien! proyecto creado con exito!.',
                type: 'success',
                duration:'3000'
              });
              this.project.nombre='';
              this.project.cliente='';
              this.traer_proyectos();
            }
        });
      },
      traer_proyectos(){
        axios.get('api/proyecto').then((res)=>{
            this.proyectos = res.data;
            this.loading = false;
        });
      },

      logout: function () {
                this.$confirm('Seguro que quieres salir ?', 'Confirmation', {
                }).then(() => {
                    this.$auth.logout({
                        makeRequest: true,
                        redirect: '/'
                    });
                });
            },
    }
  }
</script>

<style type="text/css">
  .navbar-global {
  background-color: indigo;
}

.navbar-global .navbar-brand {
  color: white;
}

.navbar-global .navbar-user > li > a
{
  color: white;
}

.navbar-primary {
  background-color: #333;
  bottom: 0px;
  left: 0px;
  position: fixed;
  top: 51px;
  /*width: 200px;*/
  height: 100%;
  z-index: 8;
  overflow: hidden;
  -webkit-transition: all 0.1s ease-in-out;
  -moz-transition: all 0.1s ease-in-out;
  transition: all 0.1s ease-in-out;
}



.btn-expand-collapse:hover,
.btn-expand-collapse:focus {
    background-color: #222;
    color: white;
}

.btn-expand-collapse:active {
    background-color: #111;
}

.navbar-primary-menu,
.navbar-primary-menu li {
  margin:0; padding:0;
  list-style: none;
}

.navbar-primary-menu li a {
  display: block;
  padding: 10px 18px;
  text-align: left;
  border-bottom:solid 1px #444;
  color: #ccc;
}

.navbar-primary-menu li a:hover {
  background-color: #000;
  text-decoration: none;
  color: white;
}

.navbar-primary-menu li a .glyphicon {
  margin-right: 6px;
}

.navbar-primary-menu li a:hover .glyphicon {
  color: orchid;
}

.main-content {
  margin-top: 70px;
  margin-left: 200px;
  padding: 20px;
}

.collapsed + .main-content {
  margin-left: 60px;
}
</style>
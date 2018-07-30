<!--Master Page Home-->
<template>
  <div>
      <nav class="navbar navbar navbar-dark bg-dark fixed-top">
        <ul class="nav">
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
            <button @click="logout" >Salir</button>
          </li>
        </ul>	
      </nav>
<nav class="navbar-primary">
  <!-- <a href="#" class="btn-expand-collapse"><span class="glyphicon glyphicon-menu-left">kkck</span></a> -->
  <ul class="navbar-primary-menu">
    <li>
      <el-button style="margin-top:20px;" class="btn-block" icon="el-icon-edit" type="primary" round> Proyecto</el-button>
    </li>
    <li>
      <a href="#"><span class="glyphicon glyphicon-list-alt"></span><span class="nav-label">Dashboard</span></a>
      <a href="#"><span class="glyphicon glyphicon-envelope"></span><span class="nav-label">Profile</span></a>
      <a href="#"><span class="glyphicon glyphicon-cog"></span><span class="nav-label">Settings</span></a>
      <a href="#"><span class="glyphicon glyphicon-film"></span><span class="nav-label">Notification</span></a>
      <a href="#"><span class="glyphicon glyphicon-calendar"></span><span class="nav-label">Monitor</span></a>
    </li>
  </ul>
</nav>
  <div class="main-content">
     <router-view :key="$route.path"></router-view>  
  </div>

</div>
</template>

<script type="text/javascript">
  export default{

    created(){
      $('.btn-expand-collapse').click(function(e) {
        $('.navbar-primary').toggleClass('collapsed');
      });
    },
    methods:{
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
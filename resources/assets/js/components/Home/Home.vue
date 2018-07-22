<!--Master Page Home-->
<template>
   <div>
      <nav class="navbar navbar navbar-dark bg-dark">
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

         <router-view :key="$route.path"></router-view>  

      </div>
   </div>
</template>

<script type="text/javascript">
  export default{
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
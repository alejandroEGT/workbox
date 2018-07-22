<template>
   <div>
      <nav class="navbar navbar navbar-dark bg-dark">
        <ul class="nav">
          <li class="nav-item">
            <router-link style="color:white" :to="{name:'login'}" class="nav-link active color">Login</router-link>
          </li>
          <li class="nav-item">
            <router-link style="color:white" :to="{name:'registro'}"class="nav-link">Registro</router-link>
          </li>
          <li class="nav-item">
            <router-link style="color:white" :to="{name:'terminos'}" class="nav-link">Terminos</router-link>
          </li>
        </ul>	
      </nav>	
        <br>
          <div class="row justify-content-md-center">
              <div class="col-md-2 ">
                <img height="125" width="150" src="https://images.vexels.com/media/users/3/145821/isolated/preview/44247e29bf035ece825b8b2bf8af88c2-rocket-ilustraci-n-ilustraci-n-cohete-by-vexels.png"> +
              </div>
          </div>
          <div class="row justify-content-md-center">
            <div class="col-7">
              
                <router-view></router-view>  
          
            </div>
          </div>
      </div>
   </div>
</template>
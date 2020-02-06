<template>
<div class="container-fluid ">
  <nav class="navbar navbar-expand-md navbar-custom navbar-default p-0 mt-3">
    <div class="container-fluid nav-img p-2">
      <!-- <a class="navbar-brand link" href="#">iWander</a> -->
      <router-link to="/" class="nav-link link">iWander</router-link>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false">
          <span class="navbar-toggler-icon"><i class="fa fa-bars fa-1x" style="color:black; font-size:28px;"></i></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Left Side Of Navbar -->
        <ul class="navbar-nav mr-auto">

        </ul>

        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto">
          <autocomplete> </autocomplete>
          <li class="nav-item">
            <router-link to="/home" class="nav-link link">Browse</router-link>
          </li>
          <li class="nav-item">
              <router-link to="/login" class="nav-link link">How To</router-link>
          </li>
          <li class="nav-item" >
              <router-link v-on:logged="checkIfLoggedIn" to="/login" class="nav-link link" v-if="isLoggedin === false">Sign In</router-link>
          </li>
          <li class="nav-item" >
              <router-link to="/register" class="nav-link link" v-if="isLoggedin === false">Sign Up</router-link>
          </li>

          <li class="nav-item dropdown" v-if="isLoggedin === true">
            <a id="navbarDropdown" class="nav-link link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
              My Account<span class="caret"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                  <router-link to="/my-profile" class="dropdown-item">My Profile</router-link>
                  <router-link to="/home" class="dropdown-item">Settings</router-link>
            </div>

          </li>

          <li class="nav-item">
            <a class="nav-link link" @click="logout" v-if="isLoggedin === true">
                Logout
            </a>
          </li>

        </ul>


      </div>

    </div>
  </nav>
</div>
</template>

<script>
import autocomplete from './autocomplete'

  export default{
    name: 'navbar',
    props: ['app'],
    components: {
      autocomplete
    },
    data(){
      return{
        isLoggedin: this.checkIfLoggedIn()
      }
    },
    mounted(){
      this.checkIfLoggedIn();
      // let app = this;
      // this.$on("logged", ()=>{
      //   isLoggedin = this.checkIfLoggedIn()
      // });
    },
    methods: {
      logout(){
        let token = localStorage.getItem('token');
        axios.get('/api/logout',{
          headers: {Authorization: "Bearer " + token}
        })
        .then(function(response){
          console.log(response);
        })
        .catch(function(error){
          console.log(error);
        });
        this.$router.replace({name: 'register'});
        console.log("USER LOGGED OUT");
        localStorage.removeItem('token');
      },
      checkIfLoggedIn(){
        let token = localStorage.getItem("token");
        if(token) {
          return true
        } else {
          return false
        }
      }
    }
  }
</script>

<!-- /* <style scoped>
  .site-name{
    color: black;
  }

  .link{
    color: black;
  }
</style> */ -->

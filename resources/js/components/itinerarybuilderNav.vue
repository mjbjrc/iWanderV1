<template>
  <div class="container-fluid">
    <nav class="navbar navbar-expand-md navbar-custom navbar-default p-0 mt-3">
      <div class="container-fluid nav-img p-2">
        <!-- <a class="navbar-brand link" href="#">iWander</a> -->
        <!-- <router-link to="/" class="nav-link link"><h4><span class="lnr lnr-chevron-left"></span> Back</h4></router-link> -->
        <h4 @click="$router.go(-1)"><span class="lnr lnr-chevron-left"></span> Back</h4>
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
          </ul>
        </div>
      </div>
    </nav>
  </div>
</template>
<script>
import autocomplete from './autocomplete'
export default{
  name: 'itinerarybuilderNav',
  props:[],
  components: {
    autocomplete
  },
  data(){
    return{

    }
  },
  methods:{
  }

}
</script>
<style>
</style>

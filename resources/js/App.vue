<template>
  <div>
    <navbar :app="this"></navbar>

    <!-- <spinner v-if="loading"></spinner> -->
    <!-- <div v-else-if="initiated"> -->
      <router-view> </router-view>

    <!-- </div> -->
  </div>
</template>

<script>
import navbar from './components/navbar'
  export default{
    name: 'app',
    components: {
      navbar
    },
    data(){
      return{
        user: ""
      }
    },
    // mounted(){
    //   this.init();
    // },
    methods: {
      init(){
        let token = localStorage.getItem("token");
        axios.get('/api/user',{
          headers: { Authorization: "Bearer " + token }
        })
        .then(response => {
          this.user = response.data;
          console.log(this.user.id);
        })
        .catch(function(error){
          console.log(error);
        });
      }
    }
  }
</script>

<style>
</style>

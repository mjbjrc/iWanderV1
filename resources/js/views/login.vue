<template>
  <div class="container">
      <div class="row justify-content-center mt-5">
          <div class="col-lg-5 col-md-8 sign-in">
              <h2 class="text-center h2-text">Sign In</h2>
              <p class="text-center mt-3">
                  Don't have an account yet? <a><router-link to="/register">Sign Up</router-link></a>
              </p>
              <hr/>

              <form v-on:submit.prevent="login">
                  <div class="form-group row justify-content-center">
                    <div class="col-md-9">
                      <label for="email">Email</label>
                      <input id="email" type="email" v-model="email" class="form-control" name="email" required autocomplete="email" autofocus>
                  </div>
                </div>

                  <div class="form-group row justify-content-center">
                    <div class="col-md-9">
                      <label for="password">Password</label>
                      <input id="password" v-model="password" type="password" class="form-control" name="password" required autocomplete="current-password">
                    </div>
                  </div>
                  <div class="form-group row">
                      <div class="col-md-6 offset-md-5">
                          <div class="form-check">
                              <a class="btn btn-link float-right" href="#">
                                  Forgot your password?
                              </a>
                          </div>
                      </div>
                  </div>
                  <div class="form-group row mb-0 justify-content-center">
                      <div class="col-md-8 text-center">
                          <button type="submit" class="btn btn-primary buttons">
                              SIGN IN
                          </button>
                      </div>
                  </div>
              </form>
          </div>
      </div>
  </div>

</template>

<script>

  export default{
    name: 'login',
    props: ['app'],
    components: {

    },
    data(){
      return {
        name: "",
        email: "",
        password: ""
      }
    },
    // mounted(){
    //   if (localStorage.getItem("token") !== null){
    //     this.$router.replace({name: 'home'});
    //     console.log("USER LOGGED IN");
    //   }
    // },
    methods: {
      login(){
        let app = this;
        axios.post('/api/login',{
          email: app.email,
          password: app.password
        })
        .then(function(response){
          console.log(response.data);
          app.name = response.data.name;
          app.email = response.data.email;
          localStorage.setItem("token", response.data.token);
          //go to home
          app.$router.replace({name: 'home'});
        })
        .catch(function(error){
          console.log(error);
        });
      },
      getCountries(){
        let app = this;
        let token = localStorage.getItem("token");
        axios.get('/api/countries',{
          headers: { Authorization: "Bearer" + token }
        })
        .then(function(response){
          console.log(response);
          app.countries = response.data.data;
        })
        .catch(function(error){
          console.log(error);
        });
      }
    }
  }
</script>

<style scoped>


</style>

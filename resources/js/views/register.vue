<template>
  <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-8 sign-in">
            <h2 class="text-center h2-text">Sign Up</h2>
            <p class="text-center mt-3">
                Already have an account? <a><router-link to="/login">Sign In</router-link></a>
            </p>
            <hr/>
                      <form v-on:submit.prevent="register">
                          <div class="form-group row justify-content-center">
                            <div class="col-md-9">
                              <label for="name">Name</label>
                              <input id="name" type="text" v-model="name" class="form-control" name="name" required autocomplete="name" autofocus>
                            </div>
                          </div>

                          <div class="form-group row justify-content-center">
                            <div class="col-md-9">
                              <label for="email">Email Address</label>
                              <input id="email" type="email" v-model="email" class="form-control" name="email" required autocomplete="email">
                            </div>
                          </div>

                          <div class="form-group row justify-content-center">
                            <div class="col-md-9">
                              <label for="password">Password</label>
                              <input id="password" type="password" v-model="password" class="form-control" name="password" required autocomplete="new-password">
                            </div>
                          </div>

                          <div class="form-group row justify-content-center">
                            <div class="col-md-9">
                              <label for="password-confirm">Confirm password</label>
                              <input id="password-confirm" v-model="passwordConfirmation" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                          </div>

                          <div class="form-group row justify-content-center ">
                            <div class="col-md-8 text-center mt-2">
                              <p>
                                By clicking Sign up, I agree to iWander's <a href="#">Terms & Conditions</a> and <a href="#">Privacy Policy</a>.
                              </p>
                            </div>
                          </div>

                          <div class="form-group row justify-content-center">
                              <div class="col-md-8 text-center">
                                  <button type="submit" class="btn btn-primary buttons">
                                      Register
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
    name: 'register',
    props: ['app'],
    components: {

    },
    data(){
      return{
        name: '',
        email: '',
        password: '',
        passwordConfirmation: ''
        // errors: []
      }
    },
    methods: {
      register(){
        let app = this;
        axios.post('/api/register',{
          name: app.name,
          email: app.email,
          password: app.password,
          passwordConfirmation: app.passwordConfirmation
        })
        .then(function(response){
          console.log(response.data);
          app.name = response.data.name;
          app.email = response.data.email;
          localStorage.setItem("token", response.data.token);
          //go to home page
          app.$router.replace({name: 'home'});
        })
        .catch(function(error){
          console.log(error);
        });
      },
    }
  }
</script>

<style scoped>


</style>

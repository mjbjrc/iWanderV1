<template>
  <div class="container">
      <div class="row justify-content-center mt-5">
          <div class="col-lg-5 col-md-8 sign-in">
              <h2 class="text-center h2-text">Create a Travel Itinerary</h2>
              <hr/>
              <form v-on:submit.prevent="getUserId">
                  <div class="form-group row justify-content-center">
                    <div class="col-md-12 mt-3">
                      <label for="destination">Destination</label>
                      <input id="destination" type="text" class="form-control" v-model="destination" name="destination" required autocomplete="email" autofocus>
                    </div>
                  </div>
                  <div class="form-group row justify-content-center">
                    <div class="col mb-3">
                      <label for="start_date">Start Date</label>
                      <input id="start_date" type="date" class="form-control" v-model="start_date" name="start_date" required autocomplete="current-password">
                    </div>
                    <div class="col">
                      <label for="end_date">End Date</label>
                      <input id="end_date" type="date" class="form-control" v-model="end_date" name="end_date" required autocomplete="current-password">
                    </div>
                  </div>
                  <div class="form-group row mb-0 justify-content-center">
                      <div class="col-md-8 text-center mt-2">
                          <button type="submit" class="btn btn-primary buttons">
                              CREATE
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
  name: 'createItinerary',
  props: ['app'],
  components: {

  },
  data(){
    return {
      destination: "",
      start_date: "",
      end_date: "",
      user_id: ""
    }
  },
  methods: {
    getUserId(){
      let app = this;
      let token = localStorage.getItem("token");
      // console.log(token);
      axios.get('/api/user',{
        headers: { Authorization: "Bearer " + token }
      })
      .then(response => {
        app.user_id = response.data.user.id
        console.log(app.user_id);
        this.createItinerary();
      })
      .catch(function(error){
        console.log(error);
      });
    },
    createItinerary(){
      console.log();
      let app = this;
      axios.post('/api/createitinerary',{
        destination: app.destination,
        start_date: app.start_date,
        end_date: app.end_date,
        user_id: app.user_id
      })
      .then(function(response){
        console.log(response.data.data.id);
        //go to addtoitinerary page and pass parameters
        app.$router.push({name: 'addtoitinerary', params: { query: app.destination, itinerary_id: response.data.data.id }});
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

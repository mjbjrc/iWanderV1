<template>
  <div>
    <div class="container">
        <div class="row justify-content-center">
          <div class="col-12 col-lg-4 main-heading">
              <h6 class="subheading mt-5">{{ results.location.city }}</h6>
              <h1>{{results.name}}</h1>
          </div>
          <div class="col-12 col-lg-7 offset-lg-1 item-image">
              <img :src="results.featured_image" class="mt-5"/>
          </div>
          <div class="col-lg-12">
            <hr/>
            <div class="col-lg-12">
            <h3>Description</h3>
            <div class="row">
              <div class="col">
                <p>
                  Ratings: <i class="fa fa-star"></i> {{ results.user_rating.aggregate_rating }} <br/>
                  <!-- <span style="color:#{{$response['user_rating']['rating_color']}};">{{$response['user_rating']['rating_text']}}</span> <br/> -->
                  Cuisines: {{results.cuisines}} <br/>
                  Average cost for two: {{results.currency}} {{results.average_cost_for_two}}<br/><br/>
                </p>
              </div>
              <div class="col">
                Highlights: <br/>
                <p v-for="highlight in results.highlights">
                    <i class="fa fa-check"></i>{{highlight}}
                </p>
              </div>
              <div class="col">
                <b-button variant="primary" @click="setBookmark(results)">Add to bookmarks</b-button>
              </div>

            </div>
          </div>
          <hr/>
          </div>
          <div class="col-lg-12">
            <div class="col-lg-12">
              <h3>Opening Hours</h3>
              <p v-for="time in results.timings.split('),')">
                  {{time}}) <br/>
              </p>
            </div>
            <hr/>
          </div>
          <div class="col-lg-12">
            <div class="col-lg-12">
              <h3>Contact</h3>
              <p v-for="number in results.phone_numbers.split(',')">
                  <i class="fa fa-phone"></i> {{number}} <br/>
              </p>
            </div>
            <hr/>
          </div>
          <div class="col-lg-12">
            <div class="col-lg-12">
              <h3>Location</h3>
              <p v-for="address in results.location.address.split(',')">
                  {{ address }}
              </p>
            </div>
            <hr/>
          </div>
        </div>
    </div>


  </div>
</template>
<script>
const ZomatoBASEURL = "https://developers.zomato.com/api/v2.1/restaurant?";
const API_key = "223bdf4a4bffe3c07d3766b4be4efa5a";

const config = { headers: {'user-key': API_key} };

//get restaurant URL
function getRestaurant(res_id){
  return ZomatoBASEURL + "res_id=" + res_id;
}

export default{
  name: 'restaurant',
  components: {},
  props: ['app','res_id'],
  data(){
    return{
      results: [],
      user_id: ""
      // restaurant_id: this.$route.params.res_id,
    }
  },
  mounted(){
    this.viewRestaurant(this.$route.params.res_id);
  },
  methods: {
    viewRestaurant(query){
      let app = this;
      axios.get(getRestaurant(query), config)
      .then(function(response){
        app.results = response.data;
      })
      .catch(function(error){
        console.log(error);
      });

    },
    setBookmark(results){
      let app = this;
      let token = localStorage.getItem("token");
      axios.get('/api/user',{
        headers: { Authorization: "Bearer " + token }
      })
      .then(response => {
        app.user_id = response.data.user.id;
        // app.restaurant_id = results.id
        // app.restaurant_id =
        //call addToBookmarks method
        this.addToBookmarks();
      })
      .catch(function(error){
        console.log(error);
      });
    },
    addToBookmarks(){
      let app = this;
      let token = localStorage.getItem("token");
      axios.post('/api/bookmarks', {
        user_id: app.user_id,
        restaurant_id: this.$route.params.res_id
      })
      .then(response => {
        console.log("SUCCESS");
        console.log(response.data);
      })
      .catch(function(error){
        console.log(error);
      });
    }
  }
}
</script>
<style>
br {
  display:block;
  content: "";
  margin-top:0px;
  /* line-height:10px; */
}
</style>

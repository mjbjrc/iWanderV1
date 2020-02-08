<template>
  <div>
    <itinerarybuilderNav></itinerarybuilderNav>
    <div class="container">
      <div class="row iwander-row">
        <div class="col-lg-12 text-center">
          <h2 class="body-content">{{this.duration}} in {{this.destination}}</h2>
          <hr/>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <b-card no-body>
            <b-tabs pills card vertical>
              <b-tab title="Day 1">
                <div class="card mb-3 body-content" v-for="restaurant in restaurants" :key="restaurant.data.id">
                    <div class="row no-gutters">
                        <div class="col-md-4">
                            <img class="card-img" :src="restaurant.data.featured_image" alt="Card image">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h2>
                                  {{restaurant.data.cuisines}}
                                </h2>
                                <h5 class="card-title">
                                  <router-link :to="{ name: 'restaurant', params: {res_id: restaurant.data.id} }" class="link">{{restaurant.data.name}}</router-link>
                                </h5>
                                <p class="card-text"><i class="fa fa-star"></i> {{ restaurant.data.user_rating.aggregate_rating }}</p>
                                <button class="btn btn-primary buttons float-right" @click="editEvent">
                                    Edit
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
              </b-tab>
              <b-tab title="Day 2">

              </b-tab>
              <b-tab title="Day 3">

              </b-tab>
              <b-tab title="Day 4">

              </b-tab>
            </b-tabs>
          </b-card>
        </div>
        <!-- <div class="col-lg-9">
          <div class="card mb-3 body-content" v-for="restaurant in restaurants" :key="restaurant.data.id">
              <div class="row no-gutters">
                  <div class="col-md-4">
                      <img class="card-img" :src="restaurant.data.featured_image" alt="Card image">
                  </div>
                  <div class="col-md-8">
                      <div class="card-body">
                          <h2>
                            {{restaurant.data.cuisines}}
                          </h2>
                          <h5 class="card-title">
                            <router-link :to="{ name: 'restaurant', params: {res_id: restaurant.data.id} }" class="link">{{restaurant.data.name}}</router-link>
                          </h5>
                          <p class="card-text"><i class="fa fa-star"></i> {{ restaurant.data.user_rating.aggregate_rating }}</p>
                          <span class="lnr lnr-plus-circle float-right" @click="showModal(restaurant.data.id)" id="show_modal"></span>
                      </div>
                  </div>
              </div>
          </div>
        </div> -->
          <!-- <modal v-if="show_modal" @close="show_modal = false" :data="this.res_id" :itinerary_id="this.itinerary_id"> </modal> -->
      </div>
    </div>
  </div>
</template>
<script>
import itinerarybuilderNav from '../components/itinerarybuilderNav'
const API_key = "223bdf4a4bffe3c07d3766b4be4efa5a";
const config = { headers: {'user-key': API_key} };

export default {
  name: 'saveItinerary',
  props: ['itinerary_id','duration','destination'],
  components:{
    itinerarybuilderNav
  },
  data(){
    return{
      // itineraryId: this.$route.params.itinerary_id,
      events: [],
      restaurants: [],
      // days: this.$route.params.days,
      // destination: this.$route.params.destination
    }
  },
  mounted(){
    this.viewEvents();
  },
  methods: {
    viewEvents(){
      let app = this;
      let token = localStorage.getItem("token");
      axios.get('/api/viewEvents',{
        headers: {'Authorization': 'Bearer ' + token},
        params: {
          itineraryId: this.$route.params.itinerary_id,
        }
      })
      .then(response => {
        let results = response.data.data;
        app.events = results;
        console.log(results);
        this.viewRestaurant();
      })
      .catch(function(error){
        console.log(error);
      });
    },
      viewRestaurant(){
        let app = this;
        axios.all(app.events.map(u => axios.get(`https://developers.zomato.com/api/v2.1/restaurant?res_id=${u.restaurant_id}`, config)))
        .then(axios.spread((...res) => {
          // console.log(res);
          app.restaurants = res;
          console.log(app.restaurants);
        }));
      },
      editEvent(){

      }
  }
}
</script>

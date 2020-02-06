<template>
  <div>
    <div class="col">
      <h2>ITINERARY</h2>
      <div v-for="restaurant in restaurants">
        <router-link :to="{ name: 'restaurant', params: {query: restaurant.data.id} }" class="link">{{restaurant.data.name}}</router-link>
        <p>
          {{restaurant.data.location.locality_verbose}}
        </p>
        <hr/>
      </div>
    </div>

  </div>
</template>
<script>
const API_key = "223bdf4a4bffe3c07d3766b4be4efa5a";
const config = { headers: {'user-key': API_key} };

export default {
  name: 'saveItinerary',
  props: ['itinerary_id'],
  components:{},
  data(){
    return{
      itineraryId: this.itinerary_id,
      events: [],
      restaurants: [],
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
          itineraryId: app.itineraryId
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
      }
  }
}
</script>

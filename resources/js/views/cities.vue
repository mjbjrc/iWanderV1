<template>
  <div>
    <b-card-group columns>
      <b-card
      v-for="result in results"
      :key="result.restaurant.id"
      :img-src="result.restaurant.featured_image"
      :img-alt="result.restaurant.name">
        <b-card-text>
          <a :href="result.restaurant.url" target="_blank">{{result.restaurant.name}}</a>
        </b-card-text>
      </b-card>
    </b-card-group>
  </div>
</template>
<script>
const ZomatoBASEURL = "https://developers.zomato.com/api/v2.1";
const API_key = "223bdf4a4bffe3c07d3766b4be4efa5a";

const config = { headers: {'user-key': API_key} };

//get city URL
function cityUrl(city){
  return ZomatoBASEURL + "/locations?query=" + city;
}

//search restaurant URL
function restaurantUrl(city_id){
  return ZomatoBASEURL + '/search?entity_id=' + city_id + '&entity_type=city'
}

export default{
  name: 'cities',
  props: ['query'],
  components: {

  },
  data(){
    return {
      city_id: '',
      results: []
    }
  },
  mounted(){
    this.getCity(this.query);
  },
  methods: {
    getCity(query){
      let app = this;
      axios.get(cityUrl(query), config)
      .then(function(response){
        let results = response.data.location_suggestions;

        results.forEach((result)=>{
          //get city_id
          console.log(result.city_id);
          app.city_id = result.city_id;
          // console.log(app.city_id);
        })
        app.getRestaurants(app.city_id);
      })
      .catch(function(error){
        console.log(error);
      });
    },
    getRestaurants(city_id){
      let app = this;
      axios.get(restaurantUrl(city_id), config)
      .then(function(response){
        let restaurants = response.data.restaurants;
        app.results = restaurants;
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

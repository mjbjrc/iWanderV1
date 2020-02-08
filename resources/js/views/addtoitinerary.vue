<template>
  <div>
    <itinerarybuilderNav></itinerarybuilderNav>
    <div class="container mt-4 body-content">
          <div class="row">
            <div class="col pt-2">
              <h2>{{this.days}} in {{this.$route.params.destination}}</h2>
            </div>
            <div class="flex-end">
              <router-link :to="{ name: 'saveItinerary',params: { itinerary_id: this.$route.params.itinerary_id, duration: this.days, destination: this.$route.params.destination }}"><button type="submit" class="btn btn-primary buttons">
                  PROCEED
              </button></router-link>
            </div>
          </div>
          <hr/>
          <div class="row">
            <div class="col-lg-3 col-sm-12 filter-box mt-2" style="height: 500px;">
                <div>
                    <h4>Refine</h4>
                    <hr />
                    <ul class="list-group">
                        <li>
                          <h6>test</h6>
                        </li>
                        <li>
                          <h6>test</h6>
                        </li>
                        <li>
                          <h6>test</h6>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-9 col-sm-12">
              <form>
                      <div class="form-group col-lg-4 ml-auto">
                          <select class="custom-select">
                              <option selected>Sort By</option>
                              <option value="">Name</option>
                              <option value="">Popularity</option>
                              <option value="">Rating</option>
                          </select>
                  </div>
              </form>
              <b-tabs content-class="mt-3" fill pills>
                <b-tab title="Attractions" active><p>ATTRACTIONS</p></b-tab>
                <b-tab title="Restaurants">
                  <restaurants v-if="dataloaded" :place="destination" :itinerary_id="this.$route.params.itinerary_id"></restaurants>
                </b-tab>

              </b-tabs>
            </div>

          </div>
    </div>
  </div>
</template>
<script>
var moment = require('moment');

import itinerarybuilderNav from '../components/itinerarybuilderNav'
import restaurants from '../components/restaurants'
import addEvent from '../components/addEvent'

export default{
  name: "addtoitinerary",
  props: ['app','destination','itinerary_id'],
  components:{
    restaurants,
    addEvent,
    itinerarybuilderNav
  },
  mounted(){
    // this.place = this.query;
    this.getItinerary();
    this.dataloaded = true;

  },
  data(){
    return{
      // destination: this.$route.params.destination,
      // itinerary_id: this.itinerary_id,
      dataloaded: false,
      moment: moment,
      itinerary: '',
      days: ''
    }
  },
  methods:{
    getItinerary(){
      console.log();
      let app = this;
      let token = localStorage.getItem("token");
      // console.log(token);
      axios.get('/api/getItinerary',{
        headers: { Authorization: "Bearer " + token }
      })
      .then(function(response){
        console.log("WHAT");
        console.log(response.data.data);
        app.itinerary = response.data.data;
        app.countDays();
      })
      .catch(function(error){
        console.log(error);
      });
    },
    countDays(){
      let app = this;
      let start = moment(app.itinerary.start_date);
      let end   = moment(app.itinerary.end_date);
      end.from(start);       // "in 5 days"
      let day = end.from(start, true); // "5 days"
      app.days = day;
      console.log(app.days);
    }
  }
}
</script>
<style>
</style>

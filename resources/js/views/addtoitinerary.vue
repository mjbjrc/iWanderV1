<template>
  <div class="container mt-4">
        <div>
          <router-link :to="{ name: 'saveItinerary',params: { itinerary_id: this.itinerary_id}}"><button type="submit" class="btn btn-primary buttons">
              PROCEED
          </button></router-link>
          <b-tabs content-class="mt-3">
            <b-tab title="Attractions" active><p>ATTRACTIONS</p></b-tab>
            <b-tab title="Restaurants">
              <restaurants v-if="dataloaded" :place="place" :itinerary_id="this.itinerary_id"></restaurants>
            </b-tab>
          </b-tabs>
        </div>
  </div>
</template>
<script>
import restaurants from '../components/restaurants'
import modal from '../components/modal'

export default{
  name: "addtoitinerary",
  props: ['app','query', 'itinerary_id'],
  components:{
    restaurants,
    modal,
  },
  mounted(){
    this.place = this.query;
    this.dataloaded = true;
  },
  data(){
    return{
      place: "",
      dataloaded: false
    }
  },
  methods:{

  }
}
</script>
<style>
</style>

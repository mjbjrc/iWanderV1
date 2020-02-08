<template>
  <transition name="modal">
    <div class="modal-mask">
      <div class="modal-wrapper">
        <div class="modal-container">

          <div class="modal-header">
            <slot name="header">
              Add to Itinerary
            </slot>
          </div>

          <div class="modal-body">
            <slot name="body">
              <form v-on:submit.prevent="addtoitinerary">
                  <div class="form-group row justify-content-center">
                    <div class="col-md-9">
                      <label for="start_time">Start time</label>
                      <input id="start_time" type="time" v-model="start_time" class="form-control" name="start_time" required autocomplete="start_time" autofocus>
                  </div>
                </div>

                  <div class="form-group row justify-content-center">
                    <div class="col-md-9">
                      <label for="end_time">End time</label>
                      <input id="end_time" v-model="end_time" type="time" class="form-control" name="end_time" required autocomplete="end_time">
                    </div>
                  </div>
                  <div class="form-group row justify-content-center">
                    <div class="col-md-9">
                      <label for="date">Date</label>
                      <input id="date" v-model="date" type="date" class="form-control" name="date" required autocomplete="date">
                    </div>
                  </div>
                  <div class="form-group row justify-content-center">
                    <div class="col-md-9">
                      <label for="notes">Notes</label>
                      <textarea id="notes" v-model="notes" type="text" class="form-control" name="notes" required autocomplete="notes"></textarea>
                    </div>
                  </div>
                  <div class="form-group row mb-0 justify-content-center">
                      <div class="col-md-8 text-center">
                          <button type="submit" @click="$emit('close')" class="btn btn-primary buttons">
                              ADD TO ITINERARY
                          </button>
                      </div>
                  </div>
              </form>
            </slot>
          </div>
        </div>
      </div>
    </div>
  </transition>
</template>
<script>
export default{
  name: "addEvent",
  props: ['app','data','itinerary_id'],
  components:{

  },
  mounted(){
  },
  data(){
    return{
      start_time: "",
      end_time: "",
      date: "",
      notes: "",
      restaurant_id: this.data,
      itineraryId: this.itinerary_id
    }
  },
  methods:{
    addtoitinerary(){
      let app = this;
      axios.post('/api/addtoitinerary',{
        restaurant_id: app.restaurant_id,
        start_time: app.start_time,
        end_time: app.end_time,
        date: app.date,
        notes: app.notes,
        itinerary_id: app.itineraryId
      })
      .then(function(response){
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
</style>

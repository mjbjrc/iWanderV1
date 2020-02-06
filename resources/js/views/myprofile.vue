<template>
  <div class="container mt-5">
    <div class="col-lg-12 justify-content-center">
      <div class="row">
        <div class="col">
          <h2>My Profile</h2>
          <div class="profile-deets" v-for="detail in user">
              <p>{{detail.name}}</p>
              <p>{{detail.email}}</p>
          </div>
        </div>
        <div class="col">
          <h2>BOOKMARKS</h2>
          <div v-for="restaurant in restaurants">
            <router-link :to="{ name: 'restaurant', params: {query: restaurant.data.id} }" class="link">{{restaurant.data.name}}</router-link>
            <p>
              {{restaurant.data.location.locality_verbose}}
            </p>
            <hr/>
          </div>
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
  name: 'myprofile',
  components: {},
  data(){
    return{
      bookmarks: [],
      restaurants: [],
      user: ""
    }
  },
  mounted(){
    this.viewBookmark();
    this.getUser();
  },
  methods:{
    viewBookmark(){
      let app = this;
      let token = localStorage.getItem("token");
      axios.get('/api/viewbookmarks',{
        headers: { Authorization: "Bearer " + token }
      })
      .then(response => {
        console.log("SUCCESS");
        // console.log(response.data);
        let results = response.data.data;
        app.bookmarks = results;
        console.log(results);
        this.viewRestaurant();
        // results.forEach((result)=>{
        //   console.log(result.restaurant_id);
        //   app.restaurants = result.restaurant_id;
        // })

      })
      .catch(function(error){
        console.log(error);
      });
  },
  viewRestaurant(){
    let app = this;
    //for each bookmarks restaurant_id, get restaurant data
    axios.all(app.bookmarks.map(u => axios.get(`https://developers.zomato.com/api/v2.1/restaurant?res_id=${u.restaurant_id}`, config)))
    .then(axios.spread((...res) => {
      // console.log(res);
      app.restaurants = res;
      console.log(app.restaurants);
    }));
  },
  getUser(){
    let app = this;
    let token = localStorage.getItem("token");
    axios.get('/api/user',{
      headers: { Authorization: "Bearer " + token }
    })
    .then(response => {
      app.user = response.data;
    })
    .catch(function(error){
      console.log(error);
    });
  }
}
}
</script>
<style>
.profile-deets{
  font-family: "Poppins";
  /* text-align: center; */
}
</style>

<template>
<div>
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-4 order-2 main-heading">
                <h6 class="subheading mt-5">Europe</h6>
                <h1>{{this.city}}</h1>
            </div>
            <div class="col-12 col-lg-7 offset-lg-1 order-lg-2 item-image body-content">
                <img :src="image_src" class="mt-5" />
            </div>
            <div class="col-lg-4 order-lg-3 order-4">
                <form>
                    <div class="row create-plan-md">

                        <div class="col-12 form-heading">
                            <h4>Create a Travel Plan</h4>
                        </div>

                        <div class="form-group col-12">
                            <label for="destination">Destination</label>
                            <input type="text" class="form-control" id="destination">
                        </div>

                        <div class="form-group col-12">
                            <label for="start_date">Start Date</label>
                            <input type="date" class="form-control" id="start_date">
                        </div>

                        <div class="form-group col-12">
                            <label for="end_date">End Date</label>
                            <input type="date" class="form-control" id="end_date">
                        </div>

                        <div class="form-button col-12">
                            <button class="btn btn-primary" type="submit">Create</button>
                        </div>

                    </div>
                </form>
            </div>
            <div class="col-lg-7 offset-lg-1 order-lg-4 order-3 iwander-desc">
                <p>
                    France has been the world's most popular tourist destination for decades, and geographically, it is one of the most diverse countries in Europe. Its cities are holiday hot spots and contain some of the greatest treasures in
                    Europe, its countryside is prosperous and well tended, and it boasts dozens of major tourist attractions, like Paris, the French Riviera, the Atlantic beaches, the winter sport resorts of the French Alps, as well as the castles of
                    the Loire Valley, Brittany, and Normandy. The country is renowned for its gastronomy, particularly wines and cheeses, as well as its history, culture, and fashion industry.
                </p>
                <p>
                    You'll find that the French people are very polite and may react coldly to you if you forget this. You might be surprised as you're greeted by other customers and the proprieter when you walk into a restaurant or a shop. Be sure
                    to take your sightseeing off the beaten path in France. Besides the famous Eiffel Tower and the chic resorts of the Côte d'Azur (French Riviera) you'll find many places to visit in the form of museums filled with fine art, crafts,
                    and archaeological relics, wonderful medieval villages and castles, diverse national parks, and local shopping direct from artisans themselves.
                </p>
                <!-- <p>
                    Whether you're touring the Christmas Markets or going skiing during winter, viewing the springtime influx of color in Provence, sunbathing on the Mediterranean coast in the summer, or watching the fall foliage against the backdrop
                    of the châteaux in the Loire Valley, you're sure to find just the right place to be. Spring is a time when the tourist attractions are just starting to expand their hours, but it may still be cold in the mountainous regions and
                    the north. Summer is the busiest time in France with the longest hours for many museums and attractions, but it's often when you will experience the most crowds. Winter in France is filled with winter carnivals, Christmas Markets,
                    and of course, skiing. Fall is a time to celebrate the release of Beaujolais nouveau wine in November, as well as experience Nuit Blanche, a day in October when major attractions, museums, galleries, parks, and swimming pools
                    remain open all night. France is in Europe.
                </p> -->
            </div>
        </div>
        <div class="row iwander-row">
            <div class="col-12 section-heading">
                <h3>Districts of {{this.city}}</h3>
            </div>
            <div class="col-12">

            </div>
        </div>
        <div class="row iwander-row">
            <div class="col-12 section-heading">
                <h3>Cities of {{this.city}}</h3>
            </div>
            <div class="col-12">

            </div>
        </div>
        <div class="row iwander-row">

            <div class="col-12 section-heading">
                <h3>Where to eat in {{this.city}}</h3>
            </div>

            <div class="col-12">
                <div class="row">
                    <div v-if="showLess" class="col-6 col-lg-3 col-sm-6" v-for="result in limitResults()" :key="result.restaurant.id">
                        <div class="card-b" >
                            <!-- Card Buttons -->
                            <div class="card-buttons">
                                <a href="#" class="card-action" title="Add to Bookmarks">
                                    <span class="lnr lnr-bookmark"></span>
                                </a>
                                <a href="#" class="card-action" title="Add to Travel Itinerary">
                                  <span class="lnr lnr-file-add"></span>
                                </a>
                            </div>
                            <!-- Card Image style="width:300px; height:200px;"-->
                            <a href="#">
                              <!-- <div style="background: black; width:100%; height:200px;"> -->
                                <img :src="result.restaurant.featured_image" class="img-fluid" :img-alt="result.restaurant.name">
                              <!-- </div> -->

                                <div class="card-b-body">
                                    <p class="rating">
                                      <span class="lnr lnr-star"></span>{{result.restaurant.user_rating.aggregate_rating}}
                                    </p>
                                    <p class="city">
                                        <router-link :to="{ name: 'restaurant', params: {res_id: result.restaurant.id} }">{{result.restaurant.name}}</router-link>
                                    </p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div> <!-- close -->

        </div>
        <div class="col-12 section-button">
            <router-link :to="{ name: 'home'}"><button class="btn btn-primary" type="submit">Show All</button></router-link>
        </div>
        <!-- </div> -->
        <!-- <div>
            <b-card-group columns>
                <b-card v-for="result in results" :key="result.restaurant.id" :img-src="result.restaurant.featured_image" :img-alt="result.restaurant.name">
                    <b-card-text>
                        <router-link :to="{ name: 'restaurant', params: {query: result.restaurant.id} }">{{result.restaurant.name}}</router-link>
                    </b-card-text>
                </b-card>
            </b-card-group>

        </div> -->
        <!-- <h1>{{this.city}}</h1> -->
    </div>
</div>
</template>
<script>
const ZomatoBASEURL = "https://developers.zomato.com/api/v2.1";
const API_key = "223bdf4a4bffe3c07d3766b4be4efa5a";

const config = {
    headers: {
        'user-key': API_key
    }
};

//get city URL
function cityUrl(city) {
    return ZomatoBASEURL + "/locations?query=" + city;
}

//search restaurant URL
function restaurantUrl(city_id) {
    return ZomatoBASEURL + '/search?entity_id=' + city_id + '&entity_type=city'
}

export default {
    name: 'searchIndex',
    props: ['app', 'city'],
    components: {

    },
    data() {
        return {
            city_id: '',
            results: [],
            image_src: '/images/france1.jpeg',
            img_url: '/images/default-restaurant.jpg',
            showLess: 'true'
        }
    },
    mounted() {
        // console.log(this.query);
        console.log("WHY");
        this.getCity(this.city);
        // this.reloadPage();
        // this.getRestaurants(city_id);
    },
    methods: {
        getCity(city) {
            let app = this;
            axios.get(cityUrl(city), config)
                .then(response => {
                    let results = response.data.location_suggestions;

                    results.forEach((result) => {
                        //get city_id
                        console.log("CITY WORKS");
                        console.log(result.city_id);
                        app.city_id = result.city_id;
                    })
                    console.log("WILL THIS?");
                    console.log(app.city_id);
                    this.getRestaurants(app.city_id);


                })
                .catch(function(error) {
                    console.log(error);
                });
        },
        getRestaurants(city_id) {
          console.log("this is called");
            let app = this;
            axios.get(restaurantUrl(city_id), config)
                .then(function(response) {
                    let restaurants = response.data.restaurants;
                    console.log(restaurants);
                    restaurants.forEach((result) => {
                      let img = result.restaurant.featured_image;
                        // console.log(result.restaurant.featured_image);
                        if(result.restaurant.featured_image == ""){
                          let img = '/images/default-restaurant.jpg';
                          result.restaurant.featured_image = img;
                        }
                    })
                    app.results = restaurants;
                    console.log()
                })
                .catch(function(error) {
                    console.log(error);
                });
        },
        limitResults(){
          let app = this;
          if(this.showLess){
            return app.results.slice(0,8)
          }
        }
    }
}
</script>
<style>
.title {
    padding: 20px;
}
</style>

<template>
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-12 col-sm-12 sort-box">
            <div>
                <div class="row">
                    <div class="card mb-3" v-for="result in results" :key="result.restaurant.id">
                        <div class="row no-gutters">
                            <div class="col-md-4">
                                <img class="card-img" :src="result.restaurant.featured_image" alt="Card image">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <router-link :to="{ name: 'restaurant', params: {res_id: result.restaurant.id} }">{{result.restaurant.name}}</router-link>
                                    </h5>
                                    <p class="card-text"><i class="fa fa-star"></i> {{ result.restaurant.user_rating.aggregate_rating }}</p>
                                    <span class="lnr lnr-plus-circle float-right" @click="showModal(result.restaurant.id)" id="show_modal"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <addEvent v-if="show_modal" @close="show_modal = false" :data="this.res_id" :itinerary_id="this.itinerary_id"> </addEvent>
                </div>
            </div>
        </div>

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
import addEvent from '../components/addEvent'
export default {
    name: 'restaurants',
    props: ['app', 'place', 'itinerary_id'],
    components: {
        addEvent
    },
    created() {
        this.getCity(this.place);
    },
    data() {
        return {
            results: [],
            show_modal: false,
            res_id: "",
        }
    },
    methods: {
        getCity(city) {
            let app = this;
            axios.get(cityUrl(city), config)
                .then(function(response) {
                    let results = response.data.location_suggestions;

                    results.forEach((result) => {
                        //get city_id
                        console.log(result.city_id);
                        app.city_id = result.city_id;
                        // console.log(app.city_id);
                    })
                    app.getRestaurants(app.city_id);
                })
                .catch(function(error) {
                    console.log(error);
                });
        },
        getRestaurants(city_id) {
            let app = this;
            axios.get(restaurantUrl(city_id), config)
                .then(function(response) {
                    let restaurants = response.data.restaurants;
                    app.results = restaurants;
                })
                .catch(function(error) {
                    console.log(error);
                });
        },
        showModal(id) {
            this.show_modal = true;
            this.res_id = id;
            console.log(this.res_id);
        },
    }
}
</script>
<style>
.lnr-plus-circle {
    color: black;
    font-size: 20px;
}
</style>

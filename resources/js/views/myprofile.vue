<template>
<div class="container mt-5">
    <div class="col-lg-12 justify-content-center">
        <div class="row">
            <div class="col-12 col-lg-4 order-2 profile-card">
                <div>
                    <img class="avatar" :src="image_src" />
                </div>
                <div class="profile-deets" v-for="detail in user">
                    <p>{{detail.name}}</p>
                    <p>{{detail.email}}</p>
                </div>
                <div class="text-center">
                    <button type="button" class="btn btn-primary editbtn create-button p-3" @click="showModal" id="show_modal">EDIT PROFILE</button>
                </div>
            </div>
            <div class="col-12 col-lg-7 offset-lg-1 order-lg-2">
                <b-tabs content-class="mt-3" fill pills>
                    <b-tab title="ITINERARIES">
                        <div v-for="itinerary in itineraries">
                            <h3> {{itinerary.destination}}</h3>
                            <p class="mt-2">
                                {{itinerary.start_date}} to {{itinerary.end_date}}
                            </p>
                            <hr/>
                        </div>
                    </b-tab>
                    <b-tab title="BOOKMARKS">
                        <div v-for="restaurant in restaurants">
                            <router-link :to="{ name: 'restaurant', params: {res_id: restaurant.data.id} }" class="link">
                                <h3>{{restaurant.data.name}}</h3>
                            </router-link>
                            <p class="mt-2">
                                {{restaurant.data.location.locality_verbose}}
                            </p>
                            <hr />
                        </div>
                    </b-tab>
                </b-tabs>
            </div>
        </div>
        <!--ROW CLOSING TAG-->
        <editprofile v-if="show_modal" @close="show_modal = false"> </editprofile>
    </div>

</div>
</div>
</template>
<script>
import editprofile from '../components/editprofile'
var moment = require('moment');

const ZomatoBASEURL = "https://developers.zomato.com/api/v2.1/restaurant?";
const API_key = "223bdf4a4bffe3c07d3766b4be4efa5a";

const config = {
    headers: {
        'user-key': API_key
    }
};

//get restaurant URL
function getRestaurant(res_id) {
    return ZomatoBASEURL + "res_id=" + res_id;
}


export default {
    name: 'myprofile',
    components: {
        editprofile
    },
    data() {
        return {
            bookmarks: [],
            restaurants: [],
            user: "",
            moment: moment,
            show_modal: false,
            image_src: '/images/avatar.jpg',
            itineraries: [],
            days: [],
        }
    },
    mounted() {
        this.viewItineraries();
        this.viewBookmark();
        this.getUser();
    },
    methods: {
        viewBookmark() {
            let app = this;
            let token = localStorage.getItem("token");
            axios.get('/api/viewbookmarks', {
                    headers: {
                        Authorization: "Bearer " + token
                    }
                })
                .then(response => {
                    // console.log("SUCCESS");
                    // console.log(response.data);
                    let results = response.data.data;
                    app.bookmarks = results;
                    console.log(results);
                    this.viewRestaurant();
                })
                .catch(function(error) {
                    console.log(error);
                });
        },
        viewRestaurant() {
            let app = this;
            //for each bookmarks restaurant_id, get restaurant data
            axios.all(app.bookmarks.map(u => axios.get(`https://developers.zomato.com/api/v2.1/restaurant?res_id=${u.restaurant_id}`, config)))
                .then(axios.spread((...res) => {
                    // console.log(res);
                    app.restaurants = res;
                    console.log(app.restaurants);
                }));
        },
        getUser() {
            let app = this;
            let token = localStorage.getItem("token");
            axios.get('/api/user', {
                    headers: {
                        Authorization: "Bearer " + token
                    }
                })
                .then(response => {
                    app.user = response.data;
                })
                .catch(function(error) {
                    console.log(error);
                });
        },
        showModal() {
            this.show_modal = true;
        },
        viewItineraries() {
            let app = this;
            let token = localStorage.getItem("token");
            axios.get('/api/viewItineraries', {
                    headers: {
                        Authorization: "Bearer " + token
                    }
                })
                .then(response => {
                    let results = response.data.data;
                    results.forEach((result) => {
                      // this.countDays(result);
                      let start = moment(result.start_date);
                      let end   = moment(result.end_date);
                      end.from(start);       // "in 5 days"
                      let day = end.from(start, true); // "5 days"
                      app.days.push(day);

                        //change start date format to Month Day Year
                        let sdate_format = moment(result.start_date).format('MMM Do YYYY');
                        result.start_date = sdate_format;

                        //change end_date format to Month Day Year
                        let edate_format = moment(result.end_date).format('MMM Do YYYY');
                        result.end_date = edate_format;
                    })
                    app.itineraries = results;

                    // console.log(app.itineraries);
                })
                .catch(function(error) {
                    console.log(error);
                });
        },
    }
}
</script>
<style scoped>
.profile-deets {
    font-family: "Poppins";
    text-align: center;
    align-content: center;
}

.editbtn {
    color: white;
    margin-top: 30px;
    margin-bottom: 30px;
}

.avatar {
    padding: 20px 10px;
    border-radius: 50%;
    /* justify-content: center; */
    /* align-items: center; */
}
</style>

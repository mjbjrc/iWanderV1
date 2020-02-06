import home from './views/home';
import login from './views/login';
import register from './views/register';
import createItinerary from './views/createItinerary';
import cities from './views/cities';
import searchIndex from './views/searchIndex';
import restaurant from './views/restaurant';
import myprofile from './views/myprofile';
import addtoitinerary from './views/addtoitinerary';
import saveItinerary from './views/saveItinerary';



export default[
  {
    path: '/',
    component: home,
    name: 'home'
  },
  {
    path: '/login',
    component: login,
    name: 'login'
  },
  {
    path: '/register',
    component: register,
    name: 'register'
  },
  {
    path: '/createItinerary',
    component: createItinerary,
    name: 'createItinerary'
  },
  // {
  //   path: '/search/',
  //   component: cities,
  //   name: 'cities',
  //   props: true
  // },
  {
    path: '/search/:city',
    component: searchIndex,
    name: 'searchIndex',
    props: true
  },
  {
    path: '/restaurant/',
    component: restaurant,
    name: 'restaurant',
    props: true
  },
  {
    path: '/my-profile/',
    component: myprofile,
    name: 'myprofile',
    props: true
  },
  {
    path: '/add-to-itinerary/',
    component: addtoitinerary,
    name: 'addtoitinerary',
    props: true
  },
  {
    path: '/save-itinerary/',
    component: saveItinerary,
    name: 'saveItinerary',
    props: true
  }
]

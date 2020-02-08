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
import itinerariesIndex from './views/itinerariesIndex';
import howto from './views/howto';


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
    name: 'createItinerary',
    meta: { hideNavigation: true }
  },
  {
    path: '/search/:city',
    component: searchIndex,
    name: 'searchIndex',
    props: true
  },
  {
    path: '/restaurant/:res_id',
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
    path: '/add-to-itinerary/:destination',
    component: addtoitinerary,
    name: 'addtoitinerary',
    props: true,
    meta: { hideNavigation: true }
  },
  {
    path: '/save-itinerary/:itinerary_id/',
    component: saveItinerary,
    name: 'saveItinerary',
    props: true,
    meta: { hideNavigation: true }
  },
  {
    path: '/itinerariesIndex',
    component: itinerariesIndex,
    name: 'itinerariesIndex',
    props: true
  },
  {
    path: '/howto',
    component: howto,
    name: 'howto',
    props: true
  }


]

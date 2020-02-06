<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;


use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function collections(){
      $url = "https://developers.zomato.com/api/v2.1/collections?city_id=";
      $city_id = floor(rand(1,1000));
      $request_url = $url . $city_id;
      $curl = curl_init($request_url);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($curl, CURLOPT_HTTPHEADER, [
        'Accept: application/json',
        'user_key: 223bdf4a4bffe3c07d3766b4be4efa5a'
      ]);
      $response = json_decode(curl_exec($curl), true);;
      curl_close($curl);
      // dd($response);

      // $results = $response['value'];
      return view('searchIndex')->with('response',$response);
    }

    public function searchLocation($name){
      $url = "https://developers.zomato.com/api/v2.1";
      $query = $name;
      $request_url = $url . '/locations?query=' . $query;
      $curl = curl_init($request_url);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($curl, CURLOPT_HTTPHEADER, [
        'Accept: application/json',
        'user_key: 223bdf4a4bffe3c07d3766b4be4efa5a'
      ]);
      $response = json_decode(curl_exec($curl), true);
      curl_close($curl);

      foreach($response['location_suggestions'] as $r){
        $city_id = $r['city_id'];
      }

      // return $entity_id;
      $restaurants = $this->searchRestaurant($city_id);

      // dd($restaurants);
      // return view('user/browse/restaurants-index')->with('restaurants',$restaurants);
      // return view('searchIndex')->with('restaurants', $restaurants);
    }

    public function searchRestaurant($city_id){
      $url = "https://developers.zomato.com/api/v2.1";
      $query = $city_id;
      $request_url = $url . '/search?entity_id=' . $query . '&entity_type=city';
      $curl = curl_init($request_url);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($curl, CURLOPT_HTTPHEADER, [
        'Accept: application/json',
        'user_key: 223bdf4a4bffe3c07d3766b4be4efa5a'
      ]);
      $restaurants = json_decode(curl_exec($curl), true);
      curl_close($curl);
      // dd($restaurants);
      return $restaurants;
    }

    public function viewRestaurant($id){
      $url = "https://developers.zomato.com/api/v2.1/restaurant?";
      $restaurant_id = $id;
      $request_url = $url . 'res_id=' . $restaurant_id;
      $curl = curl_init($request_url);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($curl, CURLOPT_HTTPHEADER, [
        'Accept: application/json',
        'user_key: 223bdf4a4bffe3c07d3766b4be4efa5a'
      ]);
      $response = json_decode(curl_exec($curl), true);;
      curl_close($curl);
      // dd($response);

      // $results = $response['value'];
      return view('user/browse/restaurant')->with('response',$response);
    }

}

<?php

namespace App\Http\Controllers;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

use Illuminate\Http\Request;

class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      // $base_url = "https://maps.googleapis.com/maps/api/place/textsearch/json?";
      // $API_key = "AIzaSyAprKYoEWdsH20STO9iH9TMg2HnK4-zEAw";
      // $query = "new york city restaurants";
      // // $query = q;
      // $language = "&language=en";
      // // $fields = "name";
      //
      //  $client = new Client();
      //  $attractions = $client->get($base_url."&query=" . $query . $language . "&key=" . $API_key);
      //  $attractions = $attractions->getBody()->getContents();
      //  // dd(json_decode($attractions,true));
      //  return view('home')->with('attractions', json_decode($attractions, true));

      return view('home');
    }

    public function AllCountries() {
      $base_url = "https://restcountries.eu/rest/v2/all";
      $client = new Client();
      $countries = $client->get($base_url);
      $countries = $countries->getBody()->getContents();
      // dd(json_decode($countries,true));
      return view('Browse')->with('$countries', json_decode($countries, true));
    }

    public function popularCitiesinEu(){
      $base_url = "https://maps.googleapis.com/maps/api/place/textsearch/json?";
      $API_key = "AIzaSyAprKYoEWdsH20STO9iH9TMg2HnK4-zEAw";
      $query = "popular cities in europe";
      // $query = q;
      $language = "&language=en";
      // $fields = "name";

       $client = new Client();
       $popularInEU = $client->get($base_url."&query=" . $query . $language . "&key=" . $API_key);
       $popularInEU = $popularInEU->getBody()->getContents();

       dd(json_decode($popularInEU,true));

       return view('Browse')
                ->with('popularInEU', json_decode($popularInEU, true))
                ->with('query', $query)
                ->with('API_key',$API_key);
    }

    public function attractions($formatted_address){
      $base_url = "https://maps.googleapis.com/maps/api/place/textsearch/json?";
      $API_key = "AIzaSyAprKYoEWdsH20STO9iH9TMg2HnK4-zEAw";
      $query = $formatted_address;
      $keyword = " restaurants";
      $language = "&language=en";


       $client = new Client();
       $attractions = $client->get($base_url."&query=" . $query . $keyword . $language . "&key=" . $API_key);
       $attractions = $attractions->getBody()->getContents();
       dd($attractions['next_page_token']);
       dd(json_decode($attractions,true));
       return view('attractions')
              ->with('attractions', json_decode($attractions, true))
              ->with('query', $query)
              ->with('API_key',$API_key)
              ->with('base_url',$base_url);
    }


}

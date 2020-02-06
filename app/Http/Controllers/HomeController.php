<?php

namespace App\Http\Controllers;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
       $base_url = "https://maps.googleapis.com/maps/api/place/details/json?";
       $API_key = "AIzaSyAprKYoEWdsH20STO9iH9TMg2HnK4-zEAw";
       $place_id = "ChIJL6wn6oAOZ0gRoHExl6nHAAo";
       $fields = "name";

        $client = new Client();
        $response = $client->get($base_url."place_id=" . $place_id . "&fields=" . $fields . "&key=" . $API_key);
        // $test = json_decode()
        // dd($response);
        $response = $response->getBody()->getContents();
        // dd(json_decode($response,true));
        return view('home')->with('response', json_decode($response, true));
    }
}

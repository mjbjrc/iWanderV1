<?php

namespace App\Http\Controllers\API;
use Validator;
use App\Itinerary;
use App\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ItineraryController extends Controller
{
    public function create(Request $request){
      $validator = Validator::make($request->all(), [
          'destination' => 'required|string',
          'start_date' => 'required|date',
          'end_date' => 'required|date',
          'user_id' => 'required|integer'
      ]);

      if ($validator->fails()) {
          return response()->json($validator->errors(), 422);
      }

      $itinerary = Itinerary::create([
          'destination' => $request->destination,
          'start_date' => $request->start_date,
          'end_date' => $request->end_date,
          'user_id' => $request->user_id
      ]);

      return response()->json(['message' => 'Created an itinerary', 'data' => $itinerary], 200);
    }

    //view All Itineraries of the user
    public function view(){
      $itinerariesAttributes = Itinerary::where('user_id', auth()->user()->id)->get();
      $itineraries = $itinerariesAttributes->toArray();

      if ($itineraries === null) {
        $statusMsg = 'Itineraries not found!';
        $statusCode = 404;
      }
      else {
        return response()->json(
          [
              'data' => $itineraries
          ],
          200);
      }
    }

    //get last entry itinerary
    public function getItinerary(){
      $itineraryAttributes = Itinerary::where('user_id', auth()->user()->id)->latest('created_at')->first();
      $itinerary = $itineraryAttributes->toArray();

      if ($itinerary === null) {
        $statusMsg = 'Itinerary not found!';
        $statusCode = 404;
      }
      else {
        return response()->json(
          [
              'data' => $itinerary
          ],
          200);
      }
    }
}

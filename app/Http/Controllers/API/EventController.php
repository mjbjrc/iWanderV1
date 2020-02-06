<?php

namespace App\Http\Controllers\API;
use Validator;
use DB;
use App\Event;
use App\Itinerary;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EventController extends Controller
{
  public function create(Request $request){
    // $itinerary_id = $request->itinerary_id;
    // dd($itinerary_id);
    $validator = Validator::make($request->all(), [
        'restaurant_id' => 'required|integer',
        'start_time' => 'required|date_format:H:i',
        'end_time' => 'required|date_format:H:i',
        'date' => 'required|date',
        'notes' => 'required|string'
    ]);

    if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
    }

    $event = Event::create([
        'restaurant_id' => $request->restaurant_id,
        'start_time' => $request->start_time,
        'end_time' => $request->end_time,
        'date' => $request->date,
        'notes' => $request->notes
    ]);

    $event->itinerary()->attach(Itinerary::where('id', $request->itinerary_id)->first());
    return $event;

    return response()->json(['message' => 'Event added to itinerary', 'data' => $event], 200);
  }

  public function view(Request $request){
    //get itinerary
    $itinerary = Itinerary::where('id', $request->itineraryId)->first();

    //get the events of the itinerary
    $events = $itinerary->events()->get();


    if ($events === null) {
      $statusMsg = 'Events not found!';
      $statusCode = 404;
    }
    else {
      return response()->json(
        [
            'data' => $events
        ],
        200);
    }
  }
}

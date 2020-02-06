<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
  protected $fillable = [
      'restaurant_id', 'start_time', 'end_time', 'date', 'notes'
  ];

  public function itinerary() {
    return $this->belongsToMany('App\Itinerary','event_itineraries');
  }
}

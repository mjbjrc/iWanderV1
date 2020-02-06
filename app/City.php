<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
  public function states() {
    return $this->belongsTo('App\States', 'states_id');
  }

  // public function country() {
  //   return $this->states->country;
  // }

  public function itineraries() {
    return $this->hasMany('App\Itinerary');
  }
}

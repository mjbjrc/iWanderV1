<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class States extends Model
{
  public function country() {
    return $this->belongsTo('App\Country','country_id');
  }

  public function city() {
    return $this->hasMany('App\City');
  }
}

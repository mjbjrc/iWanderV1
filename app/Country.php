<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
  public function states() {
    return $this->hasMany('App\States');
  }

  public function cities() {
    return $this->hasManyThrough('App\City','App\States');
  }
}

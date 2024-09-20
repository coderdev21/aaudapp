<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Urbanization extends Model
{
  use HasFactory;

  protected $fillable = [
    'state_id',
    'city_id',
    'town_id',
    'name',
  ];

  public function customerOmission()
  {
    return $this->hasMany(CustomerOmission::class);
  }

  public function state()
  {
    return $this->belongsTo(State::class);
  }

  public function city()
  {
    return $this->belongsTo(City::class);
  }

  public function town()
  {
    return $this->belongsTo(Town::class);
  }
}

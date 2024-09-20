<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComercialClient extends Model
{
  use HasFactory;

  protected $fillable = [
    'nic',
    'finca',
    'ruc',
    'name',
    'state_id',
    'city_id',
    'town_id',
    'address',
    'convenio_bancario'
  ];

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

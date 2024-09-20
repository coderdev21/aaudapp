<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{

  protected $fillable = [
    'nic',
    'finca',
    'name',
    'state_id',
    'city_id',
    'town_id',
    'address',
    'cedula',
    'email',
    'telefono',
    'convenio_bancario',
    'arreglo_pago'
  ];

  public function certificate(): HasMany
  {
    return $this->hasMany(Certificate::class);
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

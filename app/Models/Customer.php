<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
  /*     public function state()
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
    } */

  public function certificate(): HasMany
  {
    return $this->hasMany(Certificate::class);
  }
}

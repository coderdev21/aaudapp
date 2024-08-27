<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class State extends Model
{
  public function city(): HasMany
  {
    return $this->hasMany(City::class);
  }

  public function town(): HasMany
  {
    return $this->hasMany(Town::class);
  }

  public function employee(): HasMany
  {
    return $this->hasMany(Employee::class);
  }

  public function customer(): HasMany
  {
    return $this->hasMany(Customer::class);
  }

  public function certificate(): HasMany
  {
    return $this->hasMany(Certificate::class);
  }
}

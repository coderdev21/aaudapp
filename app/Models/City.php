<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class City extends Model
{

  protected $fillable = [
    'name',
    'state_id',
  ];

  public function town(): HasMany
  {
    return $this->hasMany(Town::class);
  }

  public function state(): BelongsTo
  {
    return $this->belongsTo(State::class);
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

  public function urbanization(): HasMany
  {
    return $this->hasMany(Urbanization::class);
  }

  public function comercialClient(): HasMany
  {
    return $this->hasMany(Customer::class);
  }

  public function customerOmission(): HasMany
  {
    return $this->hasMany(Customer::class);
  }
}

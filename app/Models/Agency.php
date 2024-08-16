<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Agency extends Model
{
  public function employee(): HasMany
  {
    return $this->hasMany(Employee::class);
  }

  public function user(): HasMany
  {
    return $this->hasMany(User::class);
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

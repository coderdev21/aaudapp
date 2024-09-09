<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerOmission extends Model
{
  use HasFactory;

  public function agency()
  {
    return $this->belongsTo(Agency::class);
  }

  public function customerType()
  {
    return $this->belongsTo(CustomerType::class);
  }

  public function tasa()
  {
    return $this->belongsTo(Tasa::class);
  }

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function urbanization()
  {
    return $this->belongsTo(Urbanization::class);
  }
}

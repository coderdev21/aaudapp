<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerOmission extends Model
{
  use HasFactory;

  protected $fillable = [
    'contrato',
    'finca',
    'tasa',
    'start',
    'agency_id',
    'name',
    'cedula',
    'telefono',
    'email',
    'name2',
    'cedula2',
    'telefono2',
    'email2',
    'address',
    'urbanization_id',
    'status',
    'observacion',
    'email',
    'password',
    'employee_id',
    'force_renew_password'
  ];

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

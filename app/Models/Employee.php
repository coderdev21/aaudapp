<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Employee extends Model
{

  protected $guarded = [];


  public function user()
  {
    return $this->hasOne(User::class);
  }

  public function bank() : BelongsTo
  {
    return $this->belongsTo(Bank::class);
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

  public function department()
  {
    return $this->belongsTo(Department::class);
  }

  public function correspondence()
  {
    return $this->hasMany(Correspondence::class);
  }

  public function certificate()
  {
    return $this->hasMany(Certificate::class);
  }

  public function employeeType()
  {
    return $this->belongsTo(EmployeeType::class);
  }

  public function agency()
  {
    return $this->belongsTo(Agency::class);
  }
}

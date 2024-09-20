<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Bank extends Model
{

  protected $fillable = [
    'ruta_tran',
    'cta_corriente',
    'cta_cta_ahorro',
    'name',
  ];

  public function employee(): HasMany
  {
    return $this->hasMany(Employee::class);
  }
}

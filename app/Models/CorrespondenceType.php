<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CorrespondenceType extends Model
{

  protected $fillable = [
    'name'
  ];

  public function correspondence(): HasMany
  {
    return $this->hasMany(Correspondence::class);
  }
}

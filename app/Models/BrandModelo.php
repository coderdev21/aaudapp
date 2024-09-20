<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BrandModelo extends Model
{
  use HasFactory;

  protected $fillable = [
    'name',
    'brand_id'
  ];

  public function asset(): HasMany
  {
    return $this->hasMany(Asset::class);
  }

  public function brand(): BelongsTo
  {
    return $this->belongsTo(Brand::class);
  }
}

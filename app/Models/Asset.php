<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Asset extends Model
{
  use HasFactory;

  protected $fillable = [
    'name',
    'marbete',
    'brand_id',
    'asset_type_id',
    'brand_modelo_id',
    'serial',
    'agency_id',
    'department_id',
    'employee_id',
    'condition_id',
    'image',
  ];

  public function brand(): BelongsTo
  {
    return $this->belongsTo(Brand::class);
  }

  public function assetType(): BelongsTo
  {
    return $this->belongsTo(AssetType::class);
  }

  public function brandModelo(): BelongsTo
  {
    return $this->belongsTo(BrandModelo::class);
  }

  public function agency(): BelongsTo
  {
    return $this->belongsTo(Agency::class);
  }

  public function department(): BelongsTo
  {
    return $this->belongsTo(Department::class);
  }

  public function employee(): BelongsTo
  {
    return $this->belongsTo(Employee::class);
  }

  public function condition(): BelongsTo
  {
    return $this->belongsTo(Condition::class);
  }
}

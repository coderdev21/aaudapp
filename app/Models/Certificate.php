<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class Certificate extends Model
{

  protected static function boot()
  {
    parent::boot();

    static::creating(function ($model) {
      $lastRecordId = DB::table($model->getTable())->max('id');
      $nextId = $lastRecordId ? $lastRecordId + 1 : 1;
      $currentYear = Carbon::now()->year;
      $model->control_number = $nextId . '-' . $currentYear;
    });
  }


  protected $fillable = [
    'customer_id',
    'nic',
    'finca',
    'customer_name',
    'state',
    'city',
    'town',
    'address',
    'control_number',
    'agency',
    'created_by',
    'canceled_by',
    'description',
  ];


  public function employee(): BelongsTo
  {
    return $this->belongsTo(Employee::class);
  }

  public function customer(): BelongsTo
  {
    return $this->belongsTo(Customer::class);
  }

  public function agency(): BelongsTo
  {
    return $this->belongsTo(Agency::class);
  }

  public function elaborador($query)
  {
    $query = DB::table('employees')->where('user_id', Auth::user()->user_id);
    return $query;
  }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;



class Certificate extends Model
{

  use LogsActivity;

  protected static function boot()
  {
    parent::boot();

    static::creating(function ($model) {

      //Busca en la tabla 'certificates' el ultimo id y le suma uno mas
      //para agregarlo al 'control_number'
      $lastRecordId = DB::table($model->getTable())->max('id');
      $nextId = $lastRecordId ? $lastRecordId + 1 : 1;
      $currentYear = Carbon::now()->year;
      $model->control_number = $nextId . '-' . $currentYear;

      //Agrega la fecha de hoy y le suma 30 días
      $model->expiration_date = Carbon::now()->addDays(30);
    });
  }


  protected $fillable = [
    'customer_id',
    'nic',
    'finca',
    'customer_name',
    'state_id',
    'city_id',
    'town_id',
    'address',
    'control_number',
    'agency_id',
    'user_id',
    'canceled_by',
    'description',
    'expiration_date',
  ];

  public function getActivitylogOptions(): LogOptions
  {
      return LogOptions::defaults()
      ->logOnly(['description']);
  }

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

  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class);
  }


  public function state(): BelongsTo
  {
    return $this->belongsTo(State::class);
  }

  public function city(): BelongsTo
  {
    return $this->belongsTo(City::class);
  }

  public function Town(): BelongsTo
  {
    return $this->belongsTo(Town::class);
  }
}

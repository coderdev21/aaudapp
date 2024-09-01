<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Foundation\Queue\Queueable as QueueQueueable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Yebor974\Filament\RenewPassword\Contracts\RenewPasswordContract;
use Yebor974\Filament\RenewPassword\RenewPasswordPlugin;
use Yebor974\Filament\RenewPassword\Traits\RenewPassword;

class User extends Authenticatable implements RenewPasswordContract
{
  use HasFactory, Notifiable, HasRoles, RenewPassword;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'name',
    'email',
    'password',
    'employee_id',
    'force_renew_password'
  ];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array<int, string>
   */
  protected $hidden = [
    'password',
    'remember_token',
  ];

  /**
   * Get the attributes that should be cast.
   *
   * @return array<string, string>
   */
  protected function casts(): array
  {
    return [
      'email_verified_at' => 'datetime',
      'password' => 'hashed',
    ];
  }

  public function needRenewPassword(): bool
  {
    $plugin = RenewPasswordPlugin::get();

    return (
      !is_null($plugin->getPasswordExpiresIn())
      && Carbon::parse($this->{$plugin->getTimestampColumn()})->addDays($plugin->getPasswordExpiresIn()) < now()
    ) || (
      $plugin->getForceRenewPassword()
      && $this->{$plugin->getForceRenewColumn()}
    );
  }

  public function employee()
  {
    return $this->belongsTo(Employee::class);
  }

  public function department()
  {
    return $this->belongsTo(Department::class);
  }

  public function agency()
  {
    return $this->belongsTo(Agency::class);
  }
}

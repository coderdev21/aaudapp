<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Employee extends Model
{

  protected $fillable = [
    'nombre',
    'segundo_nombre',
    'apellido_paterno',
    'apellido_materno',
    'cedula',
    'seguro_social',
    'genero',
    'estado_civil',
    'fecha_nacimiento',
    'tipo_sangre',
    'image_url',
    'state_id',
    'city_id',
    'town_id',
    'address',
    'employee_number',
    'employee_type_id',
    'status',
    'start',
    'end',
    'agency_id',
    'department_id',
    'numero_resolucion',
    'numero_contrato',
    'nuemero_posicion',
    'objeto_gastp',
    'numero_planilla',
    'numero_partida',
    'salary',
    'gastos_representacion',
    'numero_partida_gasto_representacion',
    'bank_id',
    'tipo_cuenta',
    'account_number',
    'tipo_cuenta_beneficiario',
    'card_type'
  ];


  public function user()
  {
    return $this->hasOne(User::class);
  }

  public function bank(): BelongsTo
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

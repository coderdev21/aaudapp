<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Correspondence extends Model
{
    public function correspondenceType(): BelongsTo
    {
        return $this->belongsTo(CorrespondenceType::class);
    }

    public function correspondenceLog(): HasMany
    {
        return $this->hasMany(CorrespondenceLog::class);
    }


}

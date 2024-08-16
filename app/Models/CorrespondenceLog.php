<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CorrespondenceLog extends Model
{
    public function correspondence(): BelongsTo
    {
        return $this->belongsTo(Correspondence::class);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

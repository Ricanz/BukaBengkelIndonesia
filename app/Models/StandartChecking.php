<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StandartChecking extends Model
{
    protected $fillable = [
        'checking_id', 'km', 'high', 'low', 'suhu', 'wind', 'saran', 'status'
    ];

    public function checking(): BelongsTo
    {
        return $this->belongsTo(Checking::class, 'checking_id');
    }
}

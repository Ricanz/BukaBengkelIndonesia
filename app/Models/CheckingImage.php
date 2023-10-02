<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CheckingImage extends Model
{
    protected $fillable = [
        'checking_id', 'image', 'desc_id', 'type'
    ];

    public function standart(): BelongsTo
    {
        return $this->belongsTo(StandartChecking::class, 'client_id');
    }

    public function types(): BelongsTo
    {
        return $this->belongsTo(MasterChecking::class, 'desc_id');
    }
}

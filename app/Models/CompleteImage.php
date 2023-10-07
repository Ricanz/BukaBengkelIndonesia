<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CompleteImage extends Model
{
    protected $fillable = [
        'checking_id',
        'image',
        'desc_id',
        'type'
    ];

    public function master(): BelongsTo
    {
        return $this->belongsTo(MasterChecking::class, 'desc_id');
    }

    public function checking(): BelongsTo
    {
        return $this->belongsTo(Checking::class, 'checking_id')->where('checking_type', 'complete');
    }
}

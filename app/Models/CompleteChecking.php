<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CompleteChecking extends Model
{
    protected $fillable = [
        'sa_id',
        'master_checking_id',
        'checking_id',
        'value',
        'value_title',
        'type',
        'status'
    ];

    public function master(): BelongsTo
    {
        return $this->belongsTo(MasterChecking::class, 'master_checking_id');
    }
}

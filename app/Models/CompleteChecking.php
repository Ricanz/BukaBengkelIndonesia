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
        'status',
        'val_check',
        'pass',
        'val_check_post',
        'pass_post',
        'value_post',
    ];

    public function master(): BelongsTo
    {
        return $this->belongsTo(MasterChecking::class, 'master_checking_id');
    }

    public function checking(): BelongsTo
    {
        return $this->belongsTo(Checking::class, 'checking_id');
    }
    
    public function images()
    {
        return $this->hasMany(CheckingImage::class, 'checking_id');
    }

    public function images_post()
    {
        return $this->hasMany(CheckingImage::class, 'checking_id')->where('type', 'post');
    }
}

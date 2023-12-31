<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StandartChecking extends Model
{
    protected $fillable = [
        'checking_id', 'km', 'high', 'low', 'suhu', 'wind', 'saran', 'note', 'status', 'compressor', 'cabin', 'blower', 'fan', 'type'
    ];

    public function checking(): BelongsTo
    {
        return $this->belongsTo(Checking::class, 'checking_id');
    }
    
    public function images()
    {
        return $this->hasMany(CheckingImage::class, 'checking_id')->where('type', 'pre')->where('status', 'active');
    }

    public function images_post()
    {
        return $this->hasMany(CheckingImage::class, 'checking_id')->where('type', 'post')->where('status', 'active');
    }
}

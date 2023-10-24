<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Client extends Model
{
    protected $fillable = [
        'title', 'code', 'status', 'image', 'description', 'city', 'address', 'kabeng_id', 'expired_at'
    ];

    public function kabeng(): HasOne
    {
        return $this->hasOne(Employee::class, 'client_id', 'id')->where('is_kabeng', true);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'title', 'code', 'status', 'image', 'description', 'city', 'address', 'kabeng_id'
    ];
}

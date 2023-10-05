<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterChecking extends Model
{
    protected $fillable = [
        'icon',
        'name',
        'description',
        'status',
        'type'
    ];
}

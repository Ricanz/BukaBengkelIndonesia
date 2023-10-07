<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompleteChecking extends Model
{
    protected $fillable = [
        'sa_id',
        'master_checking_id',
        'checking_id',
        'value',
        'type',
        'status'
    ];
}

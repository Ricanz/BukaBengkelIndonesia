<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StandartCheckingPost extends Model
{
    protected $connection = 'mysql2';
    protected $table = 'postcheck_standar';
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterItem extends Model
{
    protected $fillable = [
        'item', 'checklist', 'status', 'slug'
    ];
}

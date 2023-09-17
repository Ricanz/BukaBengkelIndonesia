<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Checking extends Model
{
    protected $fillable = [
        'user_id', 'employee_id', 'client_id', 'sa_id', 'wo', 'plat_number', 'type_id', 'status'
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function sa(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'sa_id');
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(MasterType::class, 'type_id');
    }
}
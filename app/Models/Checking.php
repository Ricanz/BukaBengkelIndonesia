<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Checking extends Model
{
    protected $fillable = [
        'user_id', 'employee_id', 'client_id', 'sa_id', 'wo', 'plat_number', 'type_id', 'status', 'checking_type', 'number', 'saran','note', 'saran_post', 'note_post'
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

    public function advisor(): BelongsTo
    {
        return $this->belongsTo(ServiceAdvisor::class, 'sa_id');
    }

    public function types(): BelongsTo
    {
        return $this->belongsTo(MasterType::class, 'type_id');
    }

    public function standart(): HasOne
    {
        return $this->hasOne(StandartChecking::class, 'checking_id', 'id')->where('status', 'active');
    }

    public function post(): HasOne
    {
        return $this->hasOne(StandartChecking::class, 'checking_id', 'id')->where('type', 'post')->where('status', 'active');
    }

    public function complete(): HasMany
    {
        return $this->hasMany(CompleteChecking::class, 'checking_id', 'id')->where('type', 'pre')->where('status', 'active');
    }

    public function complete_post(): HasOne
    {
        return $this->hasOne(CompleteChecking::class, 'checking_id', 'id')->where('type', 'post')->where('status', 'active');
    }

    public function complete_posts(): HasMany
    {
        return $this->hasMany(CompleteChecking::class, 'checking_id', 'id')->where('type', 'post')->where('status', 'active');
    }
}

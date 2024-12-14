<?php

namespace App\Models;

use App\Models\WhatsappBatches;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhatsappNumber extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'number',
        'port',
        'address',
        'canSendPersonal',
        'isActive'
    ];

    protected $casts = [
        'canSendPersonal' => 'boolean',
        'isActive' => 'boolean'
    ];

    public function whatsappBatches()
    {
        return $this->hasMany(WhatsappBatches::class);
    }

    public function first_whatsappBatches()
    {
        return $this->hasOne(WhatsappBatches::class)->latest();
    }

    public function scopeWhereLike($query, $column, $value)
    {
        return $query->where($column, 'like', '%'.$value.'%');
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    protected $fillable = [
        'link',
        'remark',
        'points',
        'loggable_id',
        'loggable_type'
    ];

    public function loggable()
    {
        return $this->morphTo();
    }
}

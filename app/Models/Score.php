<?php

namespace App\Models;

use App\Models\Meeting;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Score extends Model
{
    use HasFactory;

    protected $fillable = [
        'meeting_id',
        'group_id',
        'points',
    ];

    public function meeting()
    {
        return $this->belongsTo(Meeting::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}

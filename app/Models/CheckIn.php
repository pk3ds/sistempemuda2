<?php

namespace App\Models;

use App\Models\User;
use App\Models\Group;
use App\Models\Meeting;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CheckIn extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'group_id',
        'meeting_id',
        'points',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function meeting()
    {
        return $this->belongsTo(Meeting::class);
    }
}

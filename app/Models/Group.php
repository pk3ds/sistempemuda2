<?php

namespace App\Models;

use App\Models\User;
use App\Models\Award;
use App\Models\Score;
use App\Models\History;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Group extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'leader_id',
        'coleader_id',
        'name',
        'description',
        'remark',
        'points',
    ];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%')
                    ->orWhere('remark', 'like', '%' . $search . '%');
            });
        });
    }

    public function resolveRouteBinding($value, $field = null)
    {
        return $this->where($field ?? 'id', $value)->withTrashed()->firstOrFail();
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function awards()
    {
        return $this->morphMany(Award::class, 'awardable');
    }

    public function histories()
    {
        return $this->morphMany(History::class, 'loggable');
    }

    public function checkIns()
    {
        return $this->hasMany(CheckIn::class);
    }

    public function scores()
    {
        return $this->hasMany(Score::class);
    }

    public function leader()
    {
        return $this->hasOne(User::class, 'leader_id');
    }

    public function coleader()
    {
        return $this->hasOne(User::class, 'coleader_id');
    }
}

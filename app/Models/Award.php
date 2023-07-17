<?php

namespace App\Models;

use App\Models\History;
use App\Models\Meeting;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Award extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'meeting_id',
        'name',
        'remark',
        'points',
        'awardable_id',
        'awardable_type'
    ];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('remark', 'like', '%' . $search . '%');
            });
        });
    }

    public function resolveRouteBinding($value, $field = null)
    {
        return $this->where($field ?? 'id', $value)->withTrashed()->firstOrFail();
    }

    public function awardable()
    {
        return $this->morphTo();
    }

    public function meeting()
    {
        return $this->belongsTo(Meeting::class);
    }

    public function histories()
    {
        return $this->morphMany(History::class, 'loggable');
    }
}

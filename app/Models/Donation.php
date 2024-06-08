<?php

namespace App\Models;

use App\Models\User;
use App\Models\UploadedFile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'name',
        'description',
        'target',
        'user_id',
        'uploaded_files_id',
    ];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            });
        });
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function uploaded_file()
    {
        return $this->belongsTo(UploadedFile::class, 'uploaded_files_id');
    }
}

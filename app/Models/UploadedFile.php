<?php

namespace App\Models;

use App\Models\Donation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UploadedFile extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id',
        'filename',
        'original_name',
        'uploadFor',
        'path',
    ];

    public $incrementing = false;

    public function donation()
    {
        return $this->hasOne(Donation::class);
    }
}

<?php

namespace App\Models;

use App\Models\WhatsappNumber;
use App\Models\Batch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhatsappBatches extends Model
{
    use HasFactory;
    protected $fillable = [
        'whatsapp_number_id',
        'job_batches_id',
        'isActive',
    ];
    
    public function whatsappNumber()
    {
        return $this->belongsTo(WhatsappNumber::class);
    }

    public function batches()
    {
        return $this->belongsTo(Batch::class);
    }
}

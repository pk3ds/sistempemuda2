<?php

namespace App\BatchHandlers;

use Illuminate\Bus\Batchable;
use App\Models\WhatsappBatches;
use Illuminate\Support\Facades\File;

class WhatsappBatchHandler
{
  protected $file;

  public function __construct($file = null)
  {
    $this->file = $file;
  }

  public function then($batch)
  {
    \Log::info('Batch completed', ['batch_id' => $batch->id]);

    if ($this->file && File::exists($this->file)) {
      File::delete($this->file);
    }

    WhatsappBatches::where('job_batches_id', $batch->id)->update([
      'isActive' => false,
    ]);
  }

  public function catch($batch, $e)
  {
    \Log::error('Batch failed', [
      'batch_id' => $batch->id,
      'error' => $e->getMessage(),
    ]);
  }
}

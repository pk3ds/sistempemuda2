<?php

namespace App\BatchHandlers;

use Illuminate\Bus\Batchable;
use App\Models\WhatsappBatches;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class WhatsappBatchHandler
{
  protected $file;

  public function __construct($file = null)
  {
    $this->file = $file;
  }

  public function then($batch)
  {
    \Log::info('BatchHandler: then callback starting', [
      'batch_id' => $batch->id,
      'total_jobs' => $batch->totalJobs,
      'processed_jobs' => $batch->processedJobs(),
      'pending_jobs' => $batch->pendingJobs,
    ]);

    try {
      DB::transaction(function () use ($batch) {
        // Update WhatsappBatches record
        $updated = WhatsappBatches::where('job_batches_id', $batch->id)
          ->where('isActive', 1)
          ->update(['isActive' => 0]);

        \Log::info('BatchHandler: updated WhatsappBatches record', [
          'batch_id' => $batch->id,
          'records_updated' => $updated,
        ]);

        // Clean up file if exists
        if ($this->file && File::exists($this->file)) {
          File::delete($this->file);
          \Log::info('BatchHandler: deleted file', [
            'batch_id' => $batch->id,
            'file' => $this->file,
          ]);
        }
      });
    } catch (\Exception $e) {
      \Log::error('BatchHandler: Error in then callback', [
        'batch_id' => $batch->id,
        'error' => $e->getMessage(),
        'trace' => $e->getTraceAsString(),
      ]);
      throw $e;
    }
  }

  public function catch($batch, $e)
  {
    \Log::error('BatchHandler: catch callback executed', [
      'batch_id' => $batch->id,
      'error' => $e->getMessage(),
      'trace' => $e->getTraceAsString(),
    ]);

    // Update WhatsappBatches record even if batch fails
    WhatsappBatches::where('job_batches_id', $batch->id)->update([
      'isActive' => 0,
    ]);
  }
}

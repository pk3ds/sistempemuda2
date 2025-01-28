<?php

namespace App\Jobs;

use App\Models\WhatsappBatches;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\File;

class WhatsappBlastingProcess implements ShouldQueue
{
  use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

  public function handle()
  {
    if (!$this->batch() || $this->batch()->cancelled()) {
      \Log::info('Job skipped - batch cancelled or missing', [
        'job_id' => $this->job->getJobId(),
      ]);
      return;
    }

    try {
      \Log::info('WhatsappBlastingProcess: Starting job', [
        'batch_id' => $this->batch()->id,
        'job_id' => $this->job->getJobId(),
        'pending_jobs' => $this->batch()->pendingJobs,
        'total_jobs' => $this->batch()->totalJobs,
      ]);

      // Your existing API call logic
      $checkCaption = isset($this->passObject['caption']);
      if ($checkCaption) {
        $api = Http::attach(
          'image',
          file_get_contents($this->file),
          'image.png'
        )->post($this->link, $this->passObject);
      } else {
        $api = Http::post($this->link, $this->passObject);
      }

      if (!$api->successful()) {
        throw new \Exception('API request failed: ' . $api->body());
      }

      // Check if this is the last job
      if ($this->batch()->pendingJobs === 1) {
        // 1 because current job hasn't completed yet
        \Log::info('WhatsappBlastingProcess: Last job detected', [
          'batch_id' => $this->batch()->id,
          'job_id' => $this->job->getJobId(),
        ]);

        // Ensure batch completion is recorded
        DB::transaction(function () {
          WhatsappBatches::where('job_batches_id', $this->batch()->id)
            ->where('isActive', 1)
            ->update(['isActive' => 0]);
        });
      }

      sleep(3);

      \Log::info('WhatsappBlastingProcess: Job completed', [
        'batch_id' => $this->batch()->id,
        'job_id' => $this->job->getJobId(),
      ]);
    } catch (\Exception $e) {
      \Log::error('WhatsappBlastingProcess: Job failed', [
        'batch_id' => $this->batch()->id,
        'job_id' => $this->job->getJobId(),
        'error' => $e->getMessage(),
        'trace' => $e->getTraceAsString(),
      ]);
      throw $e;
    }
  }

  public function failed(\Throwable $e)
  {
    \Log::error('WhatsappBlastingProcess: Job failed handler', [
      'batch_id' => $this->batch()->id ?? 'no-batch',
      'job_id' => $this->job->getJobId(),
      'error' => $e->getMessage(),
      'trace' => $e->getTraceAsString(),
    ]);
  }
}

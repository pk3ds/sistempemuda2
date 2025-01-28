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

  public $passObject;
  public $link;
  public $file;

  public $tries = 3;
  public $timeout = 300;
  public $maxExceptions = 3;

  /**
   * Create a new job instance.
   *
   * @return void
   */
  public function __construct($passObject, $link, $file)
  {
    $this->passObject = $passObject;
    $this->link = $link;
    $this->file = $file;
  }

  /**
   * Execute the job.
   *
   * @return void
   */
  public function handle()
  {
    try {
      \Log::info('Starting job process', [
        'batch_id' => $this->batch()->id,
        'job_id' => $this->job->getJobId(),
      ]);

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

      // Add completion check
      if ($this->batch()->pendingJobs === 0) {
        WhatsappBatches::where('job_batches_id', $this->batch()->id)->update([
          'isActive' => false,
        ]);

        if ($this->file && File::exists($this->file)) {
          File::delete($this->file);
        }
      }

      sleep(3);

      \Log::info('Job completed successfully', [
        'batch_id' => $this->batch()->id,
        'job_id' => $this->job->getJobId(),
      ]);
    } catch (\Exception $e) {
      \Log::error('Job failed', [
        'batch_id' => $this->batch()->id,
        'job_id' => $this->job->getJobId(),
        'error' => $e->getMessage(),
      ]);
      throw $e;
    }
  }

  public function failed(Throwable $exception)
  {
    \Log::error('Job failed in failed method', [
      'batch_id' => $this->batch()->id ?? 'no-batch',
      'error' => $exception->getMessage(),
    ]);
  }
}

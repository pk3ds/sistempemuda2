<?php

namespace App\Jobs;

use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsappBlastingProcess implements ShouldQueue
{
  use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

  public $passObject;
  public $link;
  public $file;

  public $tries = 3;
  public $timeout = 300;
  public $maxExceptions = 3;

  public function __construct($passObject, $link, $file = null)
  {
    if (empty($link)) {
      throw new \InvalidArgumentException('API link cannot be null');
    }

    $this->passObject = $passObject;
    $this->link = $link;
    $this->file = $file;

    Log::info('WhatsappBlastingProcess constructed', [
      'link' => $this->link,
      'has_file' => !empty($this->file),
      'pass_object' => $this->passObject,
    ]);
  }

  public function handle()
  {
    if (empty($this->link)) {
      Log::error('WhatsappBlastingProcess: Link is null', [
        'job_id' => $this->job->getJobId(),
      ]);
      throw new \InvalidArgumentException('API link cannot be null');
    }

    try {
      Log::info('WhatsappBlastingProcess: Starting job', [
        'batch_id' => $this->batch() ? $this->batch()->id : null,
        'job_id' => $this->job->getJobId(),
        'link' => $this->link,
      ]);

      $checkCaption = isset($this->passObject['caption']);

      if ($checkCaption && $this->file) {
        if (!file_exists($this->file)) {
          throw new \Exception("File not found: {$this->file}");
        }

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

      // Add delay between requests
      sleep(3);

      Log::info('WhatsappBlastingProcess: Job completed successfully', [
        'batch_id' => $this->batch() ? $this->batch()->id : null,
        'job_id' => $this->job->getJobId(),
      ]);
    } catch (\Exception $e) {
      Log::error('WhatsappBlastingProcess: Job failed', [
        'batch_id' => $this->batch() ? $this->batch()->id : null,
        'job_id' => $this->job->getJobId(),
        'error' => $e->getMessage(),
        'trace' => $e->getTraceAsString(),
      ]);
      throw $e;
    }
  }

  public function failed(\Throwable $e)
  {
    Log::error('WhatsappBlastingProcess: Job failed handler', [
      'batch_id' => $this->batch() ? $this->batch()->id : null,
      'job_id' => $this->job->getJobId(),
      'error' => $e->getMessage(),
    ]);
  }
}

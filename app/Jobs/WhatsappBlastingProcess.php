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
    try {
      Log::info('WhatsappBlastingProcess: Starting job', [
        'batch_id' => $this->batch() ? $this->batch()->id : null,
        'job_id' => $this->job->getJobId(),
        'link' => $this->link,
        'file_path' => $this->file,
      ]);

      $checkCaption = isset($this->passObject['caption']);

      // Configure HTTP client
      $httpClient = Http::timeout(30)->withOptions([
        'verify' => false,
        'connect_timeout' => 10,
        'http_errors' => true,
      ]);

      if ($checkCaption && $this->file) {
        if (!file_exists($this->file)) {
          Log::error('File not found', [
            'path' => $this->file,
            'absolute_path' => realpath($this->file),
            'directory_contents' => $this->file
              ? scandir(dirname($this->file))
              : [],
          ]);
          throw new \Exception("File not found: {$this->file}");
        }

        Log::info('Reading file for upload', [
          'file_path' => $this->file,
          'file_size' => filesize($this->file),
          'is_readable' => is_readable($this->file),
        ]);

        $fileContents = file_get_contents($this->file);
        if ($fileContents === false) {
          throw new \Exception("Failed to read file contents: {$this->file}");
        }

        $api = $httpClient
          ->attach('image', $fileContents, basename($this->file))
          ->post($this->link, $this->passObject);
      } else {
        $api = $httpClient->post($this->link, $this->passObject);
      }

      if (!$api->successful()) {
        throw new \Exception('API request failed: ' . $api->body());
      }

      sleep(3);

      Log::info('WhatsappBlastingProcess: Job completed successfully', [
        'batch_id' => $this->batch() ? $this->batch()->id : null,
        'job_id' => $this->job->getJobId(),
        'response' => $api->json(),
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

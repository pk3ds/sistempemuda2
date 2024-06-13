<?php

namespace App\Jobs;

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
    use Batchable ,Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $passObject;
    public $link;
    public $file;
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
        $checkCaption = isset($this->passObject['caption']);
        if ($checkCaption) {
            $api = Http::attach('image', file_get_contents($this->file), 'image.png')
                ->post($this->link, $this->passObject);
        } else {
            $api = Http::post($this->link, $this->passObject);
        }
    }
}

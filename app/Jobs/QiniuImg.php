<?php

namespace App\Jobs;

use Storage;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class QiniuImg implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    protected $site;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($site)
    {
        //
        $this->site = $site;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        if(Storage::exists($this->site['filedir'])){
            Storage::delete($this->site['filedir']);
        }
        $ch =curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->site['url']);
        curl_setopt($ch, CURLOPT_HEADER , 0);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // 设置不将爬取代码写到浏览器，而是转化为字符串
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 0);
        $img    = curl_exec($ch);
        curl_close($ch);
        Storage::put($this->site['filedir'], $img);
    }
}

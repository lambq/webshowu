<?php

namespace App\Jobs;

use Lambq\Sdk\Facades\Yunzz;
use DB;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SeoSite implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    protected $array;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($array)
    {
        //
        $this->array  = $array;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $yun    = new Yunzz();
        DB::table('websites')->where('web_url', $this->array['site'])->update([
            'web_content'   => $yun->new_seo($this->array['site']),
            'updated_at'    => date("Y-m-d H:i:s",time()),
        ]);
    }
}

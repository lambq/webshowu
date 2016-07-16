<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Storage;

class QiniuImg extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;
		/**
     * 要上传给七牛云存储的图片链接
     *
     * @var row
     */
		protected $url;
		/**
     * 要上传给七牛云存储的图片地址
     *
     * @var row
     */
		protected $filedir;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($url,$filedir)
    {
        //
				$this->url = $url;
				$this->filedir = $filedir;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $ch =curl_init(); 
        curl_setopt($ch, CURLOPT_URL, $this->url); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60); 
        $img=curl_exec($ch); 
        curl_close($ch);
        Storage::put($this->filedir, $img);
        //程序输出到机器人中！出现错误了！然后自己报警
				//BearyChatRobot::notify('队列——七牛云图片上传', '图片地址='.$this->filedir);
    }
}

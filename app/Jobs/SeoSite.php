<?php

namespace App\Jobs;

use Lambq\Sdk\Facades\Yunzz;
use DB;
use Illuminate\Support\Facades\Log;
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
        if($this->array['user']['api_url']){
            $url    = $this->array['user']['api_url']."up.php?query=".$this->array['site']."&token=".$this->array['user']['api_token'];
            $this->file_get_contents_curl($url);
        }
    }
    function file_get_contents_curl($url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);//抓取网址
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (compatible; Baiduspider/3.0; +http://www.baidu.com/search/spider.html)");//伪造百度蜘蛛头部
        $ip = '220.181.7.121';
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-FORWARDED-FOR:' . $ip, 'CLIENT-IP:' . $ip));//伪造百度蜘蛛IP
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//
        curl_setopt($ch, CURLOPT_HEADER, true); //抓取服务器信息
        curl_setopt($ch, CURLOPT_NOBODY, false); //抓取网页信息
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); //支持301跳转
        curl_setopt($ch,CURLOPT_CONNECTTIMEOUT, 30); //网页等待时间
        $data = curl_exec($ch);
        if (curl_getinfo($ch, CURLINFO_HTTP_CODE) == '200') {
            $data = explode("\r\n\r\n", $data, 2);
        }
        curl_close($ch);
        Log::info($data['1']);
    }
}

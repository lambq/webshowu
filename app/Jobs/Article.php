<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Jobs\QiniuImg, DB, phpQuery;

class Article extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;
		/**
     * 文章标题和链接
     *
     * @var row
     */
		protected $row;
		/**
     * 文章分类
     *
     * @var row
     */
    protected $cate_id;
		/**
     * 文章类型
     *
     * @var row
     */
    protected $type;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($row,$cate_id,$type)
    {
        //
				$this->row = $row;
        $this->cate_id = $cate_id;
        $this->type = $type;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
				if($this->row){
          $row = json_decode($this->row,true);
          $html = get_url_content($row['href']);
          if($html && $row['title'] !='' && $row['href'] !=''){
							if($this->type == '5118'){
									$articles = DB::table('articles')->where('art_title', $row['title'])->first();
									if($articles){
											//BearyChatRobot::notify('队列——文章采集', '文章已经存在标题='.$row['title'].'|||链接地址='.$row['href']);
									}

									$metas = array();
									phpQuery::newDoclamb($html);
									foreach(pq('meta') as $meta){
											$key = pq($meta)->attr('name');
											$value= pq($meta)->attr('content');
											$metas[strtolower($key)] = $value;
									}

									if(array_key_exists("keywords",$metas)){
										$art_tags = $metas['keywords'];
									}else{
										$art_tags = $row['title'];
									}

									if(array_key_exists("description",$metas)){
										$art_intro = $metas['description'];
									}else{
										$art_intro = $row['title'];
									}

									$insertedId = DB::table('articles')->insertGetId([
											'user_id' => '10000',
											'cate_id' => $this->cate_id,
											'art_title' => $row['title'],
											'art_tags' => $art_tags,
											'copy_from' => '本站原创',
											'copy_url' => 'http://www.webshowu.com',
											'org_url' => $row['href'],
											'art_intro' => $art_intro,
											'art_content' => $this->ImgFindShift_5118(pq('.content')->html()),
											'art_views' => '10',
											'art_status' => '3',
											'created_at' => date('Y-m-d H:i:s',time()),
											'updated_at' => date('Y-m-d H:i:s',time()),
									]);

									phpQuery::$documents = array();
									if($insertedId){
											$result = zhanzhang_push_baidu("http://www.webshowu.com/artinfo-".$insertedId.".html");
									}
							}
							/*
							if($this->type == 'weixin'){
								$articles = DB::table('articles')->where('art_title', $row['title'])->first();
								if($articles){
									//Log::info('文章已经存在===='.$title);
									return true;
								}
								if($row['title']){
									return true;
								}
								phpQuery::newDoclamb($html);
								$insertedId = DB::table('articles')->insertGetId([
										'user_id' => '10000',
										'cate_id' => $this->cate_id,
										'art_title' => $row['title'],
										'art_tags' => $row['title'],
										'copy_from' => '本站原创',
										'copy_url' => 'http://www.webshowu.com',
										'org_url' => $row['href'],
										'art_intro' => str_limit(trim(pq('#js_content')->text()),255),
										'art_content' => pq('#js_content')->html(),
										'art_views' => '10',
										'art_status' => '3',
										'created_at' => date('Y-m-d H:i:s',time()),
										'updated_at' => date('Y-m-d H:i:s',time()),
								]);
								phpQuery::$documents = array();
								if($insertedId){
									$result = zhanzhang_push_baidu("http://www.webshowu.com/artinfo-".$insertedId.".html");
								}
							}
							if($this->type == 'qrcode'){
								$articles = DB::table('qrcode')->where('qr_name', $row['title'])->first();
								if($articles){
									//Log::info('文章已经存在===='.$title);
									return true;
								}
								if($row['title']){
									return true;
								}
								phpQuery::newDoclamb($html);
								$insertedId = DB::table('qrcode')->insertGetId([
										'user_id' => '10000',
										'cate_id' => $this->cate_id,
										'org_url' => $row['href'],
										'qr_name' => $row['title'],
										'qr_pubname' => pq('.dl-horizontal dd:eq(2)')->text(),
										'qr_tags' => pq('.dl-horizontal dd:eq(1)')->text(),
										'qr_pic' => $row['pic'],
										'qr_img' => 'http://www.haoduoqun.com'.pq('.lImg')->find('img')->attr('src'),
										'qr_intro' => pq('.dl-horizontal dd:eq(0)')->text(),
										'qr_views' => pq('.dl-horizontal dd:eq(4)')->text(),
										'qr_status' => '3',
										'created_at' => date('Y-m-d H:i:s',time()),
										'updated_at' => date('Y-m-d H:i:s',time()),
								]);
								phpQuery::$documents = array();
								if($insertedId){
									$result = zhanzhang_push_baidu("http://www.webshowu.com/qrinfo-".$insertedId.".html");
								}
							}
							*/
          }else{
							//BearyChatRobot::notify('队列——文章采集', '文章内容获取到标题='.$row['title'].'|||链接地址='.$row['href']);
          }
        }else{
						//BearyChatRobot::notify('队列——文章采集', '没有接收到文章数据');
        }
    }
		/**
     * 专业处理5118文章图片
     *
     * @var row
     */
    function ImgFindShift_5118($html)
    {
        if($html){
            $array = array();
            $dochtml = phpQuery::newDoclamb($html);
            foreach(pq('img') as $img){
                $val['src1'] = pq($img)->attr('data-original');
                $array[] = $val;
            }
            foreach($array as $key => $str){
								$file = 'xiumei/'.date('Ymd',time()).'/'.md5($str['src1']).'.jpg';
								dispatch(new QiniuImg($str['src1'], $file));
                pq("img:eq($key)")->attr('src', env('lazy_loading'));
								pq("img:eq($key)")->attr('data-original', 'http://'.env('QINIU_custom').'/'.$file);
            }
            return $dochtml;
        }else{
            return false;
        }
    }
}

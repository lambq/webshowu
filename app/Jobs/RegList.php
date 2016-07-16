<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Jobs\Article, DB, phpQuery;

class RegList extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;
		/**
     * 采集数据规则
     *
     * @var row
     */
		protected $row;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($row)
    {
        $this->row = $row;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
				//不能省略这是队列工作任务类最重要的、传值方式！变量$row我传入的是一个对象值!然后把它赋给RegList类里面的私有对象$row;
				$reg  = json_decode($this->row->reg_list,true); //采集规则解析array
				$html = get_url_content($this->row->reg_url);
				if($html){
						$data = function () use ( $html, $reg ) {
								$dom_data = array();
								phpQuery::newDoclamb( $html );
								foreach(pq($reg['reg_list']) as $dom_list){
										$reg_array = array();

										foreach($reg['list'] as $dom_reg){
												if($dom_reg['is_status'] && $dom_reg['type'] == 'text'){
														$reg_array[$dom_reg['name']] = trim(pq($dom_list)->find($dom_reg['reg_list'])->text());
												}

												if($dom_reg['is_status'] && $dom_reg['type'] == 'attr'){
														if($dom_reg['ishost']){
																$reg_array[$dom_reg['name']] = $dom_reg['host'].pq($dom_list)->find($dom_reg['reg_list'])->attr($dom_reg['type_name']);
														}else{
																$reg_array[$dom_reg['name']] = pq($dom_list)->find($dom_reg['reg_list'])->attr($dom_reg['type_name']);
														}
												}
										}

										$dom_data[] = json_encode($reg_array);
								}			
								phpQuery::$documents = array();
								return $dom_data;
						};
						if($this->row->reg_content == json_encode($data())){
								//程序输出到机器人中！出现错误了！然后自己报警
								//BearyChatRobot::notify('队列——采集器', $this->row->reg_url.'这个链接地址没有数据更新！');
            }else{
                $result = $this->ArtCaiji_array_diff($data(),json_decode($this->row->reg_content,true));
                if($result){
                    DB::table('reglists')
											->where('reg_id', $this->row->reg_id)
											->update( ['updated_at'=> date('Y-m-d H:i:s', time()), 'reg_content'=>json_encode( $data() )]);
										
                    $this->ArtCaiji_queue($result, $this->row->cate_id, $this->row->reg_type);
                    return true;
                }
            }
				}else{
						//程序输出到机器人中！出现错误了！然后自己报警
						//BearyChatRobot::notify('队列——采集器', '这个网址已经失去效果='.$this->row->reg_url);
				}
    }
		/**
     * 文章一维数组进行对比返回不一样的值
     *
     * @return void
     */
    function ArtCaiji_array_diff($array1,$array2){
        if($array2!='' && $array1!=''){
            $result = array_diff($array1,$array2);
            return $result;
        }
        if($array2 == '' && $array1 !=''){}
        {
            $result = $array1;
            return $result;
        }
        return false;
    }
		/**
     * 文章队列提交
     *
     * @return void
     */
		function ArtCaiji_queue($array,$cate_id,$type){
				if($array){
						foreach ($array as $value) {
								//BearyChatRobot::notify('队列——采集器', $type.'的文章已经提交给队列了针对');
								dispatch(new Article($value,$cate_id,$type));
						}
						return true;
				}else{
						return true;
				}
    }
}

<?php

use Illuminate\Database\Seeder;

class WebsiteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //网站站点收录数据填充
        $websites = DB::connection('webshowu')->select('select * from websites');
        foreach($websites as $str){
            DB::table('websites')->insert([
            'web_id' => $str->web_id ,
            'user_id' => $str->user_id,
            'cate_id' => $str->cate_id,
            'web_name' => $str->web_name?$str->web_name:'null',
            'web_url' => $str->web_url?$str->web_url:'null',
            'web_tags' => $str->web_tags?$str->web_tags:'null',
            'web_pic' => $str->web_pic?$str->web_pic:'null',
            'web_intro' => $str->web_intro?$str->web_intro:'0',
            'web_ispay' => $str->web_ispay?$str->web_ispay:'0',
            'web_istop' => $str->web_istop?$str->web_istop:'0',
            'web_isbest' => $str->web_isbest?$str->web_isbest:'0',
            'web_islink' => $str->web_islink?$str->web_islink:'0',
            'web_ip' => $str->web_ip?$str->web_ip:'0',
            'web_grank' => $str->web_grank?$str->web_grank:'0',
            'web_brank' => $str->web_brank?$str->web_brank:'0',
            'web_srank' => $str->web_srank?$str->web_srank:'0',
            'web_arank' => $str->web_arank?$str->web_arank:'0',
            'web_instat' => $str->web_instat?$str->web_instat:'0',
            'web_outstat' => $str->web_outstat?$str->web_outstat:'0',
            'web_views' => $str->web_views?$str->web_views:'10',
            'web_status' => $str->web_status?$str->web_status:'0',
            'created_at' => $str->created_at?$str->created_at:date('Y-m-d H:i:s',time()),
            'updated_at' => $str->updated_at?$str->updated_at:date('Y-m-d H:i:s',time()),
            ]);
        }
    }
}

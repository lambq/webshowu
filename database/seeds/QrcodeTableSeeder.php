<?php

use Illuminate\Database\Seeder;

class QrcodeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //网站二维码数据填充
        $dir_qrcode = DB::connection('webshowu')->select('select * from qrcodes');
        foreach($dir_qrcode as $str){
          DB::table('qrcodes')->insert([
              'qr_id' => $str->qr_id ,
              'user_id' => $str->user_id,
              'cate_id' => $str->cate_id,
              'org_url' => '',
              'qr_name' => $str->qr_name,
              'qr_pubname' => $str->qr_pubname,
              'qr_tags' => $str->qr_tags,
              'qr_pic' => $str->qr_pic,
              'qr_img' => $str->qr_img,
              'qr_intro' => $str->qr_intro,
              'qr_views' => $str->qr_views,
              'qr_status' => $str->qr_status,
              'created_at' => $str->created_at,
              'updated_at' => $str->updated_at,
          ]);
        }
    }
}

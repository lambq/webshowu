<?php

use Illuminate\Database\Seeder;

class CategorieTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //分类数据填充
        $dir_categories = DB::connection('webshowu')->select('select * from categories');
        foreach($dir_categories as $str){
          DB::table('categories')->insert([
            'cate_id' => $str->cate_id ,
            'root_id' => $str->root_id,
            'cate_mod' => $str->cate_mod,
            'cate_name' => $str->cate_name,
            'cate_dir' => $str->cate_dir,
            'cate_url' => $str->cate_url,
            'cate_img' => $str->cate_img,
            'cate_isbest' => $str->cate_isbest,
            'cate_order' => $str->cate_order,
            'cate_keywords' => $str->cate_keywords,
            'cate_description' => $str->cate_description,
            'cate_arrparentid' => $str->cate_arrparentid,
            'cate_arrchildid' => $str->cate_arrchildid,
            'cate_childcount' => $str->cate_childcount,
            'cate_postcount' => $str->cate_postcount,
            'created_at' => $str->created_at,
            'updated_at' => $str->updated_at,
          ]);
        }
    }
}

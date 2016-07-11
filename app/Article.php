<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; //软删除

class Article extends Model
{
    //调用软删除
		use SoftDeletes;
		/**
     * 应该被调整为日期的属性
     *
     * @var array
     */
		protected $dates = ['deleted_at'];
}

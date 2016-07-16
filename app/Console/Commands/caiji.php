<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Jobs\RegList, DB; //这里 调用了队列RegList 采集规则 处理程序 调用了2个类库！DB是数据库类库、log是日志类库

class caiji extends Command
{
    /**
     * 设置用 php的artisan工具调用名字
     * 调用代码直接在命令行上抒写 php artisan caiji 就执行这个文件
     * @var string
     */
    protected $signature = 'caiji';

    /**
     * 设置写 这个命令工具的描述.
     * 只能写英文的 中文会乱码 因为编码的问题
     * @var string
     */
    protected $description = 'zhu yao shi yong lai zuo ding shi cai ji';

    /**
     * 这一行可能有些朋友基础不好的！是看不明白!
     * 加载这个类的时候、直接执行父类的析构函数方法
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 这才是我们的关键！可以开始写要执行的代码了！
     * 因为我使用不到传值！所以先不写了！你们需要那就去看laravel中文文档
     * @return mixed
     */
    public function handle()
    {
        //
        $reg_list = DB::table('reglists')->where('reg_status','3')->get(); //读取采集规则表里面所以规则
        foreach($reg_list as $str){
            dispatch(new RegList($str)); //然后遍历把它 推送给 RegList 采集规则队列
        }
    }
}

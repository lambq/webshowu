<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        $this->call(UserTableSeeder::class);
//        $this->call(ArticleTableSeeder::class);
//        $this->call(CategorieTableSeeder::class);
//        $this->call(LableTableSeeder::class);
//        $this->call(LinkTableSeeder::class);
//        $this->call(PageTableSeeder::class);
//        $this->call(WebsiteTableSeeder::class);
//        $this->call(QrcodeTableSeeder::class);
//        $this->call(ReglistTableSeeder::class);
        $this->call(AdminTableSeeder::class);
    }
}

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
        // $this->call(UsersTableSeeder::class);
        DB::table('tbl_category')->insert(['cat_name' =>'cat1','cat_desc' =>'category1']);
        DB::table('tbl_category')->insert(['cat_name' =>'cat2','cat_desc' =>'category2']);
        DB::table('tbl_category')->insert(['cat_name' =>'cat3','cat_desc' =>'category3']);
        DB::table('admins')->insert(['name' =>'administrator','email' =>'admin@gmail.com','password'=>'$2y$10$rMPFKGyy9bTbtw2XEWeUtOfT5xeTY.dsbK64nuaN9YQ4EkhomiYl2','jobtitle'=>'Admin']);
      
    }
}

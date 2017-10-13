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
        $this->call(userSeeder::class);
    }
}

class userSeeder extends Seeder{
    public function run(){
        DB::table('users')->insert([
            ['name'=>'Hau', 'email'=>'duyhau@gmail.com', 'password'=>bcrypt('nam123')],
            ['name'=>'Thu', 'email'=>'hoaithu0@gmail.com', 'password'=>bcrypt('nam123')],
            ['name'=>'Tung', 'email'=>'daitung@gmail.com', 'password'=>bcrypt('nam123')]
        ]);
    }
}
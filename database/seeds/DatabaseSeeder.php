<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

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
        Schema::table('comments', function($table) {
            $table->foreign('entry_id')->references('id')
                ->on('entries')->onDelete('cascade')->onUpdate('cascade');
        });
        Schema::table('entries', function($table) {
            $table->foreign('user_id')->references('id')
                ->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }
}

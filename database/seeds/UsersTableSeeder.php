<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (! DB::table('users')->where('email', 'kiko@sunnyface.com')->first()) {
        DB::table('users')->insert([
          'name'     => 'Kiko Seijo',
          'email'    => 'kiko@sunnyface.com',
          'password' => app('hash')->make('secret'),
          'admin' => 1,
        ]);
      }

      if (! DB::table('users')->where('email', 'foobarfoo@example.org')->first()) {
        DB::table('users')->insert([
          'name'     => 'John Smith',
          'email'    => 'foobarfoo@example.org',
          'password' => app('hash')->make('foobarfoo'),
          'admin' => 1,
        ]);
      }
    }
}

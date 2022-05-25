<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {
    $user = new User();
    $user->name = "Admin";
    $user->email = "admin@dumy.com";
    $user->password = Hash::make("12345678");
    $user->save();
    // \App\Models\User::factory(10)->create();
  }
}

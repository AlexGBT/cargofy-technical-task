<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
            factory(App\Load::class, 20)
            ->create()
            ->each(function ($load) {
                $load->routeWay()->save(factory(App\Route::class)->make());
            });
    }
}

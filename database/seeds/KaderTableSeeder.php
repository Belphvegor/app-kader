<?php

use Illuminate\Database\Seeder;

class KaderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Kader::class, 1)->create()->each(function ($kader) {
            $kader->make();
        });
    }
}

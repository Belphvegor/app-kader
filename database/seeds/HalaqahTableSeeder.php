<?php

use Illuminate\Database\Seeder;

class HalaqahTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Halaqah::class, 1)->create()->each(function ($kader) {
            $kader->make();
        });
    }
}

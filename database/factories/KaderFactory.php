<?php

use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\Models\Kader::class, function (Faker\Generator $faker) {
    return [
        'nik' => str_random(16),
        'nama' => $faker->name,
        'tempat_lahir' => $faker->cityPrefix,
        'tanggal_lahir' => $faker->dateTime(),
        'jenis_kelamin' => $faker->titleMale,
        'alamat' => $faker->address,
        'profesi' => $faker->jobTitle,
        'asal' => $faker->state,
        'provinsi'  =>  $faker->country,
        'kota'      =>  $faker->citySuffix,
        'kecamatan' => $faker->streetName,
        'kode_pos' => $faker->postcode,
        'nomor_telepon' => $faker->tollFreePhoneNumber,
        'email' => $faker->unique()->email,
        'password' => Hash::make('12345'),
        'gol_darah' => "O",
        'status' => "lajang",
    ];
});

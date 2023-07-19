<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;

class ClientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Client::create([
            'name'=>'Hussam',
            'phone'=>'0995832706',
            'address'=>'Damascus Countryside-jaramana',

        ]);
    }
}

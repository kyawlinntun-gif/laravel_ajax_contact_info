<?php

use App\Religion;
use Illuminate\Database\Seeder;

class ReligionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Religion::truncate();

        Religion::create(['name' => 'Christianity']);
        Religion::create(['name' => 'Islam']);
        Religion::create(['name' => 'Hinduism']);
        Religion::create(['name' => 'Unaffiliated']);
        Religion::create(['name' => 'Buddhism']);
        Religion::create(['name' => 'Folk Religion']);
    }
}

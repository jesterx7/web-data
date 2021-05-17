<?php

use Illuminate\Database\Seeder;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $companies  = factory(App\Company::class, 30)->create();
        $apps       = factory(App\Apps::class, 30)->create();
        $divisi     = factory(App\Divisi::class, 30)->create();
        $leader     = factory(App\Leader::class, 30)->create();
        $anak       = factory(App\Anak::class, 30)->create();
        $tutupbuka  = factory(App\TutupBuka::class, 30)->create();
    }
}

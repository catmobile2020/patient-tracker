<?php

use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $countriesArray =[
            [
                'name'=>'egypt',
                'cities'=>['cairo','alex']
            ],
            [
                'name'=>'ksa',
                'cities'=>['jada','makaa']
            ],
        ];
        foreach ($countriesArray as $one)
        {
            $country = \App\Country::create(['name'=>$one['name']]);
            if (isset($one['cities']))
            {
                foreach ($one['cities'] as $name)
                {
                    $country->cities()->create(['name'=>$name]);
                }
            }
        }
    }
}

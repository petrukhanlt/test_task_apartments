<?php

namespace Database\Seeders;

use App\Models\Apartment;
use App\Models\City;
use App\Models\SaudiRegion;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ApartmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $apartments = [];
        $row = 1;
        if (($apartmentsCsv = fopen(base_path()."/database/init/apartments-init.csv", "r")) !== false) {
            while (($data = fgetcsv($apartmentsCsv, 1000, ",")) !== false) {
                if ($row++ == 1) {
                    continue;
                }
                $num = count($data);
                $apartment = [];
                for ($column = 0; $column < $num; $column++) {
                    $apartment[] = $data[$column];
                }
                $apartments[] = $apartment;
            }
            fclose($apartmentsCsv);
        }

        foreach ($apartments as $row) {
            $apartment = new Apartment([
                'name' => $row[0],
                'price' => $row[1],
                'bedrooms' => $row[2],
                'bathrooms' => $row[3],
                'storeys' => $row[4],
                'garages' => $row[5],
            ]);

            $apartment->save();
        }
    }
}
<?php

use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        //
        $csv_file = database_path() . '/regions.csv';
        $data     = read_csv_lines($csv_file);
        $regions  = [];

        foreach ($data as $value) {
            $regions[] = $value;
        }

        DB::table('regions')->insert($regions);
    }
}

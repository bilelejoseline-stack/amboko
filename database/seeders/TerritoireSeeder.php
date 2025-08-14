<?php

namespace Database\Seeders;

use App\Models\District;
use App\Models\Territoire;
use Illuminate\Database\Seeder;

class TerritoireSeeder extends Seeder
{
    public function run(): void
    {
        $districts = District::all();

        foreach ($districts as $district) {
            Territoire::factory()
                ->count(10)
                ->create([
                    'district_id' => $district->id,
                ]);
        }
    }
}

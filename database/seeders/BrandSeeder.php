<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Brand::create([
            'name' => 'Mercedes',
            'logo' => 'https://stickers-camions.fr/4607-large_default_2x/stickers-camion-logo-mercedes.jpg'
        ]);

        Brand::create([
            'name' => 'Volkswagen',
            'logo' => 'https://upload.wikimedia.org/wikipedia/fr/thumb/e/e9/Volkswagen_2012-2019_Logo.svg/2048px-Volkswagen_2012-2019_Logo.svg.png'
        ]);

        Brand::create([
            'name' => 'Audi',
            'logo' => 'https://cdn.1min30.com/wp-content/uploads/2017/08/Logo-Audi-1.jpg'
        ]);
    }
}

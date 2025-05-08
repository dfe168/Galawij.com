<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class PaintingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Laad JSON direct vanaf base_path()
        $jsonPath = base_path('storage\app\private\gallery_final.json');
        $json = File::get($jsonPath);

        $paintings = json_decode($json, true);

        if (!$paintings) {
            throw new \Exception('Kon gallery_final.json niet inladen of JSON is ongeldig.');
        }

        foreach ($paintings as $painting) {
            DB::table('paintings')->insert([
                'img' => $painting['img'] ?? null,
                'name' => $painting['name'] ?? null,
                'medium' => $painting['medium'] ?? null,
                'width' => $painting['width'] ?? null,
                'length' => $painting['length'] ?? null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

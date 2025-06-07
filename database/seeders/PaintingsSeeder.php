<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PaintingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $paintings_json = Storage::disk('public')->get('gallery_final.json');
        $paintings = json_decode($paintings_json, true);

        if (! $paintings) {
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

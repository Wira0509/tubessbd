<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ItineraryCategorySeeder extends Seeder
{
    public function run(): void
    {
        $parentCategories = [
            1 => 'Africa Travel',
            2 => 'Asia Travel',
            3 => 'Europe Travel',
            4 => 'North America Travel',
            5 => 'South America Travel',
            6 => 'Central America Travel',
            7 => 'Caribbean Travel',
            8 => 'Middle East Travel',
            9 => 'Southeast Asia Travel',
            10 => 'Oceania Travel',
            11 => 'Antarctica',
            12 => 'United States',
            13 => 'Travel Tips',
        ];

        $insertData = [];

        foreach ($parentCategories as $id => $title) {
            $slug = $this->generateUniqueSlug($title);

            $insertData[] = [
                'id' => $id,
                'title' => $title,
                'slug' => $slug,
                'parent_id' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }

        DB::table('itinerary_categories')->insert($insertData);
    }

    private function generateUniqueSlug(string $title): string
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $i = 1;

        while (DB::table('itinerary_categories')->where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $i;
            $i++;
        }

        return $slug;
    }
}

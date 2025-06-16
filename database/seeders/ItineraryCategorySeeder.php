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
            101 => 'Africa Travel',
            102 => 'Asia Travel',
            103 => 'Europe Travel',
            104 => 'North America Travel',
            105 => 'South America Travel',
            106 => 'Central America Travel',
            107 => 'Caribbean Travel',
            108 => 'Middle East Travel',
            109 => 'Southeast Asia Travel',
            110 => 'Oceania Travel',
            111 => 'Antarctica',
            112 => 'United States',
            113 => 'Travel Tips',
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

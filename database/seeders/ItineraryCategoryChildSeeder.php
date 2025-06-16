<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ItineraryCategoryChildSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            101 => [ // Africa Travel
                'Ethiopia', 'Kenya', 'Uganda', 'Malawi', 'Namibia', 'Botswana', 'South Africa', 'Rwanda', 'Tanzania', 'Morocco', 'Egypt'
            ],
            102 => [ // Asia Travel
                'Vietnam', 'Thailand', 'Malaysia', 'Indonesia', 'Cambodia', 'Laos', 'Myanmar', 'Singapore', 'Philippines', 'India', 'Sri Lanka', 'Tibet', 'Kazakhstan', 'Kyrgyzstan', 'Uzbekistan'
            ],
            103 => [ // Europe Travel
                'Germany', 'France', 'Spain', 'Italy', 'Portugal', 'Sweden', 'Norway', 'Denmark', 'Finland', 'Netherlands', 'Belgium', 'Luxembourg', 'Switzerland', 'Austria', 'England', 'Ireland', 'Hungary', 'Czech Republic', 'Poland', 'Croatia', 'Greece', 'Scotland', 'Montenegro', 'Turkey', 'Russia'
            ],
            104 => [ // North America Travel
                'Canada', 'Mexico', 'Belize', 'Costa Rica', 'Panama', 'Cuba', 'Dominica', 'Puerto Rico', 'Jamaica', 'Barbados', 'St Kitts', 'St Lucia', 'Grand Cayman', 'Cozumel', 'Antigua', 'US Virgin Islands'
            ],
            105 => [ // South America Travel
                'Brazil', 'Argentina', 'Peru', 'Chile', 'Colombia', 'Ecuador'
            ],
            106 => [ // Central America Travel
                'Costa Rica', 'Panama', 'Belize', 'Guatemala'
            ],
            107 => [ // Caribbean Travel
                'Bahamas', 'Barbados', 'Dominica', 'St Lucia', 'St Kitts', 'Jamaica', 'Cuba', 'Puerto Rico', 'US Virgin Islands', 'Grand Cayman'
            ],
            108 => [ // Middle East Travel
                'Jordan', 'Cyprus'
            ],
            109 => [ // Southeast Asia Travel
                'Vietnam', 'Thailand', 'Cambodia', 'Laos', 'Myanmar', 'Malaysia', 'Singapore', 'Philippines', 'Indonesia'
            ],
            110 => [ // Oceania Travel
                'Australia', 'New Zealand', 'Fiji', 'Palau', 'Solomon Islands', 'French Polynesia', 'Subantarctic Islands'  
            ],
            111 => [ // Antarctica
                'Antarctica'
            ],
            112 => [ // United States
                'California', 'Florida', 'Hawaii', 'Minnesota', 'Nevada', 'New York', 'North Carolina', 'North Dakota', 'Oklahoma', 'Utah', 'Virginia', 'Wisconsin', 'Wyoming', 'Colorado', 'Arizona', 'Montana', 'Alaska'
            ],
            113 => [ // Travel Tips
                'Travel Planning', 'Travel Gear', 'Long Term Travel', 'Travel Photography',
            ]  
        ];

        foreach ($categories as $parentId => $children) {
            $parentTitle = DB::table('itinerary_categories')->where('id', $parentId)->value('title');

            foreach ($children as $category) {
                $slug = Str::slug($parentTitle . '-' . $category);
                DB::table('itinerary_categories')->insert([
                    'title' => $category,
                    'slug' => $slug,
                    'parent_id' => $parentId,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }
    }
}
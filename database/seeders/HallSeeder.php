<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\CommunityHall;
use App\Models\Room;

class HallSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Royal Regency (Wedding Category)
        $hall1 = CommunityHall::create([
            'name' => 'The Royal Regency',
            'category' => 'Wedding',
            'location' => 'West End Avenue',
            'description' => 'Opulent banquet hall featuring crystal chandeliers and a grand stage. Ideal for weddings and gala dinners.',
            'capacity' => 800,
            'price_per_day' => 2500.00,
            'price_per_hour' => 300.00,
        ]);

        Room::create([
            'community_hall_id' => $hall1->id,
            'name' => 'Bridal Suite Alpha',
            'category' => 'Luxury',
            'capacity' => 10,
            'price_per_day' => 300.00,
            'price_per_hour' => 50.00,
            'description' => 'A private luxurious room for wedding preparations.',
        ]);

        // 2. Tech Hub Center (Corporate Category)
        $hall2 = CommunityHall::create([
            'name' => 'Innovation Hub',
            'category' => 'Corporate',
            'location' => 'Silicon District',
            'description' => 'High-tech facility with gigabit internet and smart projection systems. Perfect for hackathons.',
            'capacity' => 200,
            'price_per_day' => 1200.00,
            'price_per_hour' => 150.00,
        ]);

        Room::create([
            'community_hall_id' => $hall2->id,
            'name' => 'Project Room Blue',
            'category' => 'Premium',
            'capacity' => 20,
            'price_per_day' => 400.00,
            'price_per_hour' => 60.00,
            'description' => 'Quiet workspace for intensive team collaboration.',
        ]);

        // 3. Serenity Garden Hall (Social Category)
        $hall3 = CommunityHall::create([
            'name' => 'Serenity Garden Hall',
            'category' => 'Social',
            'location' => 'Riverside Park',
            'description' => 'A beautiful hall with floor-to-ceiling windows overlooking the botanical gardens.',
            'capacity' => 150,
            'price_per_day' => 900.00,
            'price_per_hour' => 100.00,
        ]);

        Room::create([
            'community_hall_id' => $hall3->id,
            'name' => 'Tea Lounge',
            'category' => 'Standard',
            'capacity' => 30,
            'price_per_day' => 150.00,
            'price_per_hour' => 20.00,
            'description' => 'Cosy lounge for small gatherings and tea parties.',
        ]);

        // 4. Metropolitan Center (General Category)
        $hall4 = CommunityHall::create([
            'name' => 'Metropolitan Plaza',
            'category' => 'General',
            'location' => 'Downtown Gateway',
            'description' => 'Versatile space for exhibits, local markets, and community meetings.',
            'capacity' => 1000,
            'price_per_day' => 1800.00,
            'price_per_hour' => 200.00,
        ]);
    }
}

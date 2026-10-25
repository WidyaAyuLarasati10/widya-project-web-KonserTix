<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\TicketCategory;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Coldplay
        $event1 = Event::create([
            'title' => 'Coldplay Music of the Spheres Tour',
            'artist' => 'Coldplay',
            'venue' => 'Gelora Bung Karno, Jakarta',
            'event_date' => '2026-11-15 19:30:00',
            'category' => 'international',
        ]);

        $tickets1 = [
            ['name' => 'Ultimate Experience (VIP)', 'price' => 10000000, 'stock' => 10],
            ['name' => 'My Universe (VIP Standing)', 'price' => 5700000, 'stock' => 25],
            ['name' => 'CAT 1 (Numbered Seating)', 'price' => 4000000, 'stock' => 40],
            ['name' => 'Festival (Free Standing)', 'price' => 3500000, 'stock' => 100],
            ['name' => 'CAT 2 (Seated)', 'price' => 2500000, 'stock' => 60],
            ['name' => 'CAT 3 (Seated)', 'price' => 1750000, 'stock' => 75],
            ['name' => 'CAT 4 (Restricted View)', 'price' => 1250000, 'stock' => 50],
            ['name' => 'CAT 5 (Upper Tribune)', 'price' => 800000, 'stock' => 120],
        ];

        foreach ($tickets1 as $ticket) {
            TicketCategory::create(array_merge($ticket, ['event_id' => $event1->id]));
        }

        // 2. Sheila On 7
        $event2 = Event::create([
            'title' => 'Sheila On 7 - Tunggu Aku Di Jakarta',
            'artist' => 'Sheila On 7',
            'venue' => 'JIExpo Kemayoran',
            'event_date' => '2026-12-20 18:30:00',
            'category' => 'national',
        ]);

        $tickets2 = [
            ['name' => 'VIP Standing (Front Stage)', 'price' => 2200000, 'stock' => 30],
            ['name' => 'Festival A (Standing)', 'price' => 1250000, 'stock' => 80],
            ['name' => 'Festival B (Standing)', 'price' => 850000, 'stock' => 150],
            ['name' => 'CAT 1 (Seated)', 'price' => 600000, 'stock' => 100],
            ['name' => 'CAT 2 (Early Bird Seated)', 'price' => 350000, 'stock' => 50],
        ];

        foreach ($tickets2 as $ticket) {
            TicketCategory::create(array_merge($ticket, ['event_id' => $event2->id]));
        }

        // 3. Bruno Mars
        $event3 = Event::create([
            'title' => 'Bruno Mars Live in Jakarta 2026',
            'artist' => 'Bruno Mars',
            'venue' => 'Jakarta International Stadium (JIS)',
            'event_date' => '2026-11-28 20:00:00',
            'category' => 'international',
        ]);

        $tickets3 = [
            ['name' => 'VIP Package', 'price' => 9000000, 'stock' => 15],
            ['name' => 'Festival VIP A', 'price' => 4500000, 'stock' => 50],
            ['name' => 'Festival B', 'price' => 2750000, 'stock' => 100],
            ['name' => 'CAT 1 Tribune', 'price' => 1850000, 'stock' => 80],
            ['name' => 'CAT 2 Upper Tribune', 'price' => 950000, 'stock' => 120],
        ];

        foreach ($tickets3 as $ticket) {
            TicketCategory::create(array_merge($ticket, ['event_id' => $event3->id]));
        }

        // 4. Dewa 19
        $event4 = Event::create([
            'title' => 'Pesta Rakyat Dewa 19 Tour',
            'artist' => 'Dewa 19 feat. All Stars',
            'venue' => 'Stadion Siliwangi, Bandung',
            'event_date' => '2027-01-10 19:00:00',
            'category' => 'national',
        ]);

        $tickets4 = [
            ['name' => 'Super VIP Seated', 'price' => 1800000, 'stock' => 20],
            ['name' => 'Festival Front', 'price' => 950000, 'stock' => 70],
            ['name' => 'Festival Back', 'price' => 500000, 'stock' => 120],
            ['name' => 'Tribune Seated', 'price' => 300000, 'stock' => 100],
        ];

        foreach ($tickets4 as $ticket) {
            TicketCategory::create(array_merge($ticket, ['event_id' => $event4->id]));
        }

        // 5. Ariana Grande
        $event5 = Event::create([
            'title' => 'Ariana Grande Eternal Sunshine World Tour',
            'artist' => 'Ariana Grande',
            'venue' => 'Indonesia Arena, Jakarta',
            'event_date' => '2026-12-05 20:00:00',
            'category' => 'international',
        ]);

        $tickets5 = [
            ['name' => 'Eternal VIP Experience', 'price' => 9500000, 'stock' => 12],
            ['name' => 'Positions VIP Standing', 'price' => 5200000, 'stock' => 30],
            ['name' => 'CAT 1 Seated', 'price' => 3800000, 'stock' => 50],
            ['name' => 'Festival Standing', 'price' => 2800000, 'stock' => 90],
            ['name' => 'CAT 2 Seated', 'price' => 1900000, 'stock' => 70],
            ['name' => 'CAT 3 Tribune', 'price' => 950000, 'stock' => 100],
        ];

        foreach ($tickets5 as $ticket) {
            TicketCategory::create(array_merge($ticket, ['event_id' => $event5->id]));
        }

        // 6. Payung Teduh
        $event6 = Event::create([
            'title' => 'Reuni Spesial Payung Teduh - Akad Malam Minggu',
            'artist' => 'Payung Teduh',
            'venue' => 'Taman Ismail Marzuki, Jakarta',
            'event_date' => '2026-11-07 19:30:00',
            'category' => 'national',
        ]);

        $tickets6 = [
            ['name' => 'VIP Seated (Leshan & Souvenir)', 'price' => 1500000, 'stock' => 25],
            ['name' => 'Festival A (Dekat Panggung)', 'price' => 750000, 'stock' => 80],
            ['name' => 'Festival B', 'price' => 450000, 'stock' => 120],
            ['name' => 'Early Bird', 'price' => 250000, 'stock' => 40],
        ];

        foreach ($tickets6 as $ticket) {
            TicketCategory::create(array_merge($ticket, ['event_id' => $event6->id]));
        }
    }
}
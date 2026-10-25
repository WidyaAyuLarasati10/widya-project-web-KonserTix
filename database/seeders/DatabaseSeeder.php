<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\TicketCategory;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // User Dummy
        User::create([
            'name' => 'Dian',
            'email' => 'dian@gmail.com',
            'password' => Hash::make('password123'),
        ]);

        // ==========================================
        // KONSER NASIONAL
        // ==========================================

        // 1. Dewa 19
        $dewa19 = Event::create([
            'title' => 'Dewa 19 - Pesta Rakyat 30 Tahun Berkarya',
            'description' => 'Konser mahakarya Dewa 19 membawakan lagu-lagu legendaris bersama vokalis balad terbaik.',
            'location' => 'Stadion Utama GBK, Jakarta',
            'event_date' => '2026-11-20 19:30:00',
            'banner_image' => '/images/dewa19.jpg',
        ]);
        TicketCategory::create(['event_id' => $dewa19->id, 'name' => 'VIP Restoe Boemi (Numbered Seating)', 'price' => 1250000, 'stock' => 30]);
        TicketCategory::create(['event_id' => $dewa19->id, 'name' => 'CAT 1 (VIP Floor - Standing)', 'price' => 750000, 'stock' => 50]);
        TicketCategory::create(['event_id' => $dewa19->id, 'name' => 'Festival Laskar Cinta (Free Standing)', 'price' => 450000, 'stock' => 120]);
        TicketCategory::create(['event_id' => $dewa19->id, 'name' => 'Tribun Upper (Numbered Seating)', 'price' => 250000, 'stock' => 80]);

        // 2. Tulus
        $tulus = Event::create([
            'title' => 'Tulus - Tur Manusia 2026',
            'description' => 'Pengalaman musik hangat dan penuh makna bersama Tulus melantunkan lagu-lagu album Manusia.',
            'location' => 'Stadion Jatidiri, Semarang',
            'event_date' => '2026-12-05 19:00:00',
            'banner_image' => '/images/tulus.jpg',
        ]);
        TicketCategory::create(['event_id' => $tulus->id, 'name' => 'VIP Seating (Numbered Seating)', 'price' => 850000, 'stock' => 25]);
        TicketCategory::create(['event_id' => $tulus->id, 'name' => 'CAT 1 (Front Standing)', 'price' => 550000, 'stock' => 60]);
        TicketCategory::create(['event_id' => $tulus->id, 'name' => 'Festival Standing (Free Standing)', 'price' => 350000, 'stock' => 100]);
        TicketCategory::create(['event_id' => $tulus->id, 'name' => 'Tribun Hemat (Numbered Seating)', 'price' => 200000, 'stock' => 75]);

        // 3. Payung Teduh
        $payungTeduh = Event::create([
            'title' => 'Payung Teduh - Akad Malam Syahdu',
            'description' => 'Malam syahdu penuh nostalgia dan alunan puitis bersama Payung Teduh di panggung terbuka.',
            'location' => 'Taman Balekambang, Surakarta',
            'event_date' => '2026-12-12 18:30:00',
            'banner_image' => '/images/payungteduh.jpg',
        ]);
        TicketCategory::create(['event_id' => $payungTeduh->id, 'name' => 'VIP Senja Pass (Numbered Seating)', 'price' => 400000, 'stock' => 30]);
        TicketCategory::create(['event_id' => $payungTeduh->id, 'name' => 'Front Pit (Free Standing)', 'price' => 250000, 'stock' => 70]);
        TicketCategory::create(['event_id' => $payungTeduh->id, 'name' => 'Regular Lawn Pass (Free Standing)', 'price' => 150000, 'stock' => 110]);

        // 4. Pamungkas
        $pamungkas = Event::create([
            'title' => 'Pamungkas - Birdy World Tour Special Edition',
            'description' => 'Pertunjukan intim Pamungkas dengan lagu-lagu hits khas synth-pop dan ballad.',
            'location' => 'Jogja Expo Center, Yogyakarta',
            'event_date' => '2026-12-19 20:00:00',
            'banner_image' => '/images/pamungkas.jpg',
        ]);
        TicketCategory::create(['event_id' => $pamungkas->id, 'name' => 'To The Bone VIP (Numbered Seating)', 'price' => 650000, 'stock' => 35]);
        TicketCategory::create(['event_id' => $pamungkas->id, 'name' => 'Birdy Lounge (Numbered Seating)', 'price' => 450000, 'stock' => 50]);
        TicketCategory::create(['event_id' => $pamungkas->id, 'name' => 'Festival Front (Free Standing)', 'price' => 300000, 'stock' => 90]);
        TicketCategory::create(['event_id' => $pamungkas->id, 'name' => 'Festival Back (Free Standing)', 'price' => 180000, 'stock' => 120]);

        // 5. Perunggu
        $perunggu = Event::create([
            'title' => 'Perunggu - Pesta Olahraga & Musik Konser',
            'description' => 'Energi musik rock kantoran nan hangat dari grup musik Perunggu.',
            'location' => 'Bandung Convention Centre, Bandung',
            'event_date' => '2026-12-27 19:00:00',
            'banner_image' => '/images/perunggu.jpg',
        ]);
        TicketCategory::create(['event_id' => $perunggu->id, 'name' => 'Garuda VIP (Numbered Seating)', 'price' => 500000, 'stock' => 30]);
        TicketCategory::create(['event_id' => $perunggu->id, 'name' => '33x Ring Pit (Free Standing)', 'price' => 350000, 'stock' => 65]);
        TicketCategory::create(['event_id' => $perunggu->id, 'name' => 'Tribun Festival (Numbered Seating)', 'price' => 225000, 'stock' => 85]);
        TicketCategory::create(['event_id' => $perunggu->id, 'name' => 'Kantoran Pass (Free Standing)', 'price' => 150000, 'stock' => 100]);

        // ==========================================
        // KONSER INTERNASIONAL
        // ==========================================

        // 6. Taylor Swift
        $taylorSwift = Event::create([
            'title' => 'Taylor Swift - The Eras Tour Live in Jakarta',
            'description' => 'Tur sejarah dunia perjalanan karier Taylor Swift selama 3 jam penuh kejutan visual dan musik!',
            'location' => 'Stadion Utama GBK, Jakarta',
            'event_date' => '2027-01-10 18:00:00',
            'banner_image' => '/images/taylorswift.jpg',
        ]);
        TicketCategory::create(['event_id' => $taylorSwift->id, 'name' => 'Ultimate Karma VIP Package (Numbered Seating)', 'price' => 5500000, 'stock' => 15]);
        TicketCategory::create(['event_id' => $taylorSwift->id, 'name' => 'CAT 1 (VIP Floor - Free Standing)', 'price' => 3500000, 'stock' => 30]);
        TicketCategory::create(['event_id' => $taylorSwift->id, 'name' => 'CAT 2 (Festival Floor - Free Standing)', 'price' => 1800000, 'stock' => 100]);
        TicketCategory::create(['event_id' => $taylorSwift->id, 'name' => 'CAT 3 (Tribune Lower - Numbered Seating)', 'price' => 1200000, 'stock' => 80]);
        TicketCategory::create(['event_id' => $taylorSwift->id, 'name' => 'CAT 4 (Tribune Upper - Restricted View)', 'price' => 800000, 'stock' => 60]);

        // 7. Oasis
        $oasis = Event::create([
            'title' => 'Oasis - Live \'27 World Reunion Tour',
            'description' => 'Kembalinya legenda Britpop dunia Noel & Liam Gallagher di satu panggung megah!',
            'location' => 'JIExpo Kemayoran, Jakarta',
            'event_date' => '2027-01-24 19:30:00',
            'banner_image' => '/images/oasis.jpg',
        ]);
        TicketCategory::create(['event_id' => $oasis->id, 'name' => 'Wonderwall Front Pit (Free Standing)', 'price' => 3200000, 'stock' => 25]);
        TicketCategory::create(['event_id' => $oasis->id, 'name' => 'Don\'t Look Back In Anger VIP (Numbered Seating)', 'price' => 2500000, 'stock' => 40]);
        TicketCategory::create(['event_id' => $oasis->id, 'name' => 'Champagne Supernova (Free Standing)', 'price' => 1750000, 'stock' => 80]);
        TicketCategory::create(['event_id' => $oasis->id, 'name' => 'Supersonic Regular (Free Standing)', 'price' => 1100000, 'stock' => 110]);

        // 8. Ariana Grande
        $arianaGrande = Event::create([
            'title' => 'Ariana Grande - Eternal Sunshine World Tour',
            'description' => 'Vokal spektakuler dan penampilan memukau Ariana Grande menyanyikan album terbarunya.',
            'location' => 'Indonesia Arena, Jakarta',
            'event_date' => '2027-02-05 20:00:00',
            'banner_image' => '/images/arianagrande.jpg',
        ]);
        TicketCategory::create(['event_id' => $arianaGrande->id, 'name' => 'VIP Sweetener Lounge (Numbered Seating)', 'price' => 3800000, 'stock' => 20]);
        TicketCategory::create(['event_id' => $arianaGrande->id, 'name' => 'CAT 1 (Front Stage - Standing)', 'price' => 2600000, 'stock' => 45]);
        TicketCategory::create(['event_id' => $arianaGrande->id, 'name' => 'Positions Festival (Free Standing)', 'price' => 1600000, 'stock' => 75]);
        TicketCategory::create(['event_id' => $arianaGrande->id, 'name' => 'Tribune Seating (Numbered Seating)', 'price' => 950000, 'stock' => 90]);

        // 9. Justin Bieber
        $justinBieber = Event::create([
            'title' => 'Justin Bieber - Justice World Tour',
            'description' => 'Aksi panggung penuh energik dari megabintang pop dunia Justin Bieber.',
            'location' => 'Stadion Madya GBK, Jakarta',
            'event_date' => '2027-02-18 19:00:00',
            'banner_image' => '/images/justinbieber.jpg',
        ]);
        TicketCategory::create(['event_id' => $justinBieber->id, 'name' => 'Ghost VIP Experience (Numbered Seating)', 'price' => 4200000, 'stock' => 20]);
        TicketCategory::create(['event_id' => $justinBieber->id, 'name' => 'Justice Pit (Free Standing)', 'price' => 2800000, 'stock' => 50]);
        TicketCategory::create(['event_id' => $justinBieber->id, 'name' => 'Peaches Festival (Free Standing)', 'price' => 1750000, 'stock' => 90]);
        TicketCategory::create(['event_id' => $justinBieber->id, 'name' => 'Lonely Tribune (Numbered Seating)', 'price' => 1050000, 'stock' => 80]);

        // 10. Sabrina Carpenter
        $sabrinaCarpenter = Event::create([
            'title' => 'Sabrina Carpenter - Short n\' Sweet Tour',
            'description' => 'Sensasi pop terkini Sabrina Carpenter membawakan lagu Espresso, Please Please Please, dan hits lainnya!',
            'location' => 'Beach City International Stadium, Jakarta',
            'event_date' => '2027-03-02 19:30:00',
            'banner_image' => '/images/sabrinacarpenter.jpg',
        ]);
        TicketCategory::create(['event_id' => $sabrinaCarpenter->id, 'name' => 'Espresso VIP Suite (Numbered Seating)', 'price' => 3200000, 'stock' => 25]);
        TicketCategory::create(['event_id' => $sabrinaCarpenter->id, 'name' => 'Please Please Please Pit (Free Standing)', 'price' => 2100000, 'stock' => 55]);
        TicketCategory::create(['event_id' => $sabrinaCarpenter->id, 'name' => 'Taste Festival (Free Standing)', 'price' => 1300000, 'stock' => 100]);
        TicketCategory::create(['event_id' => $sabrinaCarpenter->id, 'name' => 'Short n\' Sweet Balcony (Numbered Seating)', 'price' => 850000, 'stock' => 70]);

        // 11. SZA
        $sza = Event::create([
            'title' => 'SZA - SOS World Tour Live in Jakarta',
            'description' => 'Malam penuh emosi R&B modern bersama SZA membawakan Kill Bill, Snooze, dan lagu hits favorit.',
            'location' => 'Indonesia Arena, Jakarta',
            'event_date' => '2027-03-15 20:00:00',
            'banner_image' => '/images/sza.jpg',
        ]);
        TicketCategory::create(['event_id' => $sza->id, 'name' => 'Snooze VIP Lounge (Numbered Seating)', 'price' => 3400000, 'stock' => 20]);
        TicketCategory::create(['event_id' => $sza->id, 'name' => 'Kill Bill Pit (Free Standing)', 'price' => 2250000, 'stock' => 50]);
        TicketCategory::create(['event_id' => $sza->id, 'name' => 'SOS Festival Zone (Free Standing)', 'price' => 1400000, 'stock' => 85]);
        TicketCategory::create(['event_id' => $sza->id, 'name' => 'Saturn Upper Tier (Numbered Seating)', 'price' => 900000, 'stock' => 75]);

        // 12. Daniel Caesar
        $danielCaesar = Event::create([
            'title' => 'Daniel Caesar - NEVER ENOUGH Asia Tour',
            'description' => 'Suara merdu soulful R&B Daniel Caesar membawakan Best Part, Get You, dan Always.',
            'location' => 'Balai Sarbini, Jakarta',
            'event_date' => '2027-03-28 19:30:00',
            'banner_image' => '/images/danielcaesar.jpg',
        ]);
        TicketCategory::create(['event_id' => $danielCaesar->id, 'name' => 'Best Part VIP Seating (Numbered Seating)', 'price' => 2750000, 'stock' => 25]);
        TicketCategory::create(['event_id' => $danielCaesar->id, 'name' => 'Get You Front Pit (Free Standing)', 'price' => 1850000, 'stock' => 60]);
        TicketCategory::create(['event_id' => $danielCaesar->id, 'name' => 'Always Regular Seating (Numbered Seating)', 'price' => 1200000, 'stock' => 90]);
        TicketCategory::create(['event_id' => $danielCaesar->id, 'name' => 'Cyanide Tribune (Numbered Seating)', 'price' => 750000, 'stock' => 70]);
    }
}
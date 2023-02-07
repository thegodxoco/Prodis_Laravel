<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OfferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Offer: subscription open
        DB::table('offers')->insert([
            'title' => "Oferta de ejemplo 1",
            'address' => "Sabadell",
            'province' => "Barcelona",
            'priority' => 'Urgente',
            'city' => 'Terrassa',
            'zip_code' => "08221",
            'vacant_positions' => 1,
            'description' => "Descripción de oferta 1",
            'requirements' => '["Carnet de conducir", "Experiencia"]',
            'subscriptionStartDate' => substr(str_replace("T", " ", date('Y-m-d\TH:i:sP',strtotime("-1 days"))), 0, 19),
            'subscriptionEndDate' => substr(str_replace("T", " ", date('Y-m-d\TH:i:sP',strtotime("+1 days"))), 0, 19),
            'activityStartDate' => substr(str_replace("T", " ", date('Y-m-d\TH:i:sP',strtotime("+1 days"))), 0, 19),
            'activityEndDate' => substr(str_replace("T", " ", date('Y-m-d\TH:i:sP',strtotime("+1 days"))), 0, 19),
            'created_at' => now()->format('Y-m-d H:i:s')
        ]);

        // Offer: subscription not open
        DB::table('offers')->insert([
            'title' => "Oferta de ejemplo 2",
            'address' => "Rubi",
            'province' => "Girona",
            'priority' => 'No Urgente',
            'city' => 'Sabadell',
            'zip_code' => "08221",
            'vacant_positions' => 1,
            'description' => "Descripción de oferta 2",
            'requirements' => '["Carnet de conducir", "Experiencia", "Ingles"]',
            'subscriptionStartDate' => substr(str_replace("T", " ", date('Y-m-d\TH:i:sP',strtotime("+2 days"))), 0, 19),
            'subscriptionEndDate' => substr(str_replace("T", " ", date('Y-m-d\TH:i:sP',strtotime("+10 days"))), 0, 19),
            'activityStartDate' => substr(str_replace("T", " ", date('Y-m-d\TH:i:sP',strtotime("+1 days"))), 0, 19),
            'activityEndDate' => substr(str_replace("T", " ", date('Y-m-d\TH:i:sP',strtotime("+1 days"))), 0, 19),
            'created_at' => now()->format('Y-m-d H:i:s')
        ]);

        // Offer: subscription closed
        DB::table('offers')->insert([
            'title' => "Oferta de ejemplo 3",
            'address' => "Terrassa",
            'province' => "Tarragona",
            'priority' => 'Urgente',
            'city' => 'Terrassa',
            'zip_code' => "08221",
            'vacant_positions' => 2,
            'description' => "Descripción de oferta 3",
            'requirements' => '["Carnet de conducir"]',
            'subscriptionStartDate' => substr(str_replace("T", " ", date('Y-m-d\TH:i:sP',strtotime("-2 days"))), 0, 19),
            'subscriptionEndDate' => substr(str_replace("T", " ", date('Y-m-d\TH:i:sP',strtotime("-1 days"))), 0, 19),
            'activityStartDate' => substr(str_replace("T", " ", date('Y-m-d\TH:i:sP',strtotime("+1 days"))), 0, 19),
            'activityEndDate' => substr(str_replace("T", " ", date('Y-m-d\TH:i:sP',strtotime("+1 days"))), 0, 19),
            'created_at' => now()->format('Y-m-d H:i:s')
        ]);
    }
}


//json_encode(['Carnet de conducir', 'Experiencia'])
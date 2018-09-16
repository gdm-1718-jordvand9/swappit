<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\TicketType;
use App\Festival;
use \Carbon\Carbon;

class TicketTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $festivals = Festival::pluck('id')->toArray();
        $startDate = Carbon::now()->subDays(12);
        $endDate = Carbon::now()->addDays(12);
        $today = Carbon::now();
        $tickets = [
            [
                'name'              => 'Combiticket Confort',
                'price'             => $faker->numberBetween(200,270),
                'description'       => 'Camping + Parking + Pendelbus Inbegrepen, voor alle dagen van het festival.',
            ],
            [
                'name'              => 'Dagticket Confort',
                'price'             => $faker->numberBetween(20,70),
                'description'       => 'Camping + Parking + Pendelbus Inbegrepen, voor een dag naar keuze van het festival.',
            ],
            [
                'name'              => 'Combiticket',
                'price'             => $faker->numberBetween(150,250),
                'description'       => 'Basis combiticket voor alle dagen van het festival.',
            ],
            [
                'name'              => 'Dagticket',
                'price'             => $faker->numberBetween(20,70),
                'description'       => 'Basis dagticket voor een dag naar keuze van het festival.',
            ],
            [
                'name'              => 'Parking',
                'price'             => $faker->numberBetween(8,20),
                'description'       => 'Parkingticket voor het festival.',
            ],
            [
                'name'              => 'Food / drinks',
                'price'             => $faker->numberBetween(20,40),
                'description'       => 'Ticket voor eten en drinken op het festival.',
            ],
        ];

        foreach ($festivals as $festival) {
            foreach ($tickets as $ticket) {
                $ticket['festival_id']= $festival;
                $ticket['sale_start_date'] = $faker->dateTimeBetween($startDate,$today);
                $ticket['sale_end_date'] = $faker->dateTimeBetween($today,$endDate);
                TicketType::create($ticket);
            }
        }
        /*// Pukkelpop
        $tickettype = new TicketType();
        $tickettype->name           = 'Dagticket';
        $tickettype->description    = 'In deze prijs zit het openbaar vervoer (NMBS en De Lijn), €5,5 servicekosten en €1,5 mobiliteitsbijdrage.';
        $tickettype->festival_id    = '1';
        $tickettype->price          = '100.00';
        $tickettype->save();

        $tickettype = new TicketType();
        $tickettype->name           = 'Combiticket';
        $tickettype->description    = 'In deze prijs zit het openbaar vervoer (NMBS & De Lijn), €5,5 servicekosten en €1,5 mobiliteitsbijdrage.';
        $tickettype->festival_id    = '1';
        $tickettype->price          = '205.00';
        $tickettype->save();

        $tickettype = new TicketType();
        $tickettype->name           = 'Food & Drinks voucher';
        $tickettype->description    = 'De prijs voor eet- en drankbonnen blijft dezelfde als voorgaande jaren. Een Food & Drinks voucher kost in voorverkoop €50 voor 20 stuks. Ter plaatse betaal je €15 voor 5 Food & Drinks tickets.';
        $tickettype->festival_id    = '1';
        $tickettype->price          = '50.00';
        $tickettype->save();

        $tickettype = new TicketType();
        $tickettype->name           = 'Camping Chill';
        $tickettype->description    = 'Voor Camping Chill betaal je €25, ongeacht of je een dag- of combiticket hebt. Uiteraard blijven alle faciliteiten (douches, wc’s, wc-papier, warm water, microgolfovens, etc.) gratis. Op voorhand reserveren is noodzakelijk, er wordt een Recycling Deposit (afvalwaarborg) van €10 verrekend. De waarborg kan je makkelijk recupereren.';
        $tickettype->festival_id    = '1';
        $tickettype->price          = '25.00';
        $tickettype->save();

        //Dour

        $tickettype = new TicketType();
        $tickettype->name           = '5 Dagen';
        $tickettype->description    = 'Camping + Parking + Pendelbus Inbegrepen';
        $tickettype->festival_id    = '2';
        $tickettype->price          = '170.00';
        $tickettype->save();

        $tickettype = new TicketType();
        $tickettype->name           = 'Dagticket - Woensdag';
        $tickettype->description    = 'Camping + Parking + Pendelbus Inbegrepen';
        $tickettype->festival_id    = '2';
        $tickettype->price          = '75.00';
        $tickettype->save();

        $tickettype = new TicketType();
        $tickettype->name           = 'Dagticket - Donderdag';
        $tickettype->description    = 'Camping + Parking + Pendelbus Inbegrepen';
        $tickettype->festival_id    = '2';
        $tickettype->price          = '75.00';
        $tickettype->save();

        $tickettype = new TicketType();
        $tickettype->name           = 'Dagticket - Vrijdag';
        $tickettype->description    = 'Camping + Parking + Pendelbus Inbegrepen';
        $tickettype->festival_id    = '2';
        $tickettype->price          = '75.00';
        $tickettype->save();

        $tickettype = new TicketType();
        $tickettype->name           = 'Dagticket - Zaterdag';
        $tickettype->description    = 'Camping + Parking + Pendelbus Inbegrepen';
        $tickettype->festival_id    = '2';
        $tickettype->price          = '75.00';
        $tickettype->save();

        $tickettype = new TicketType();
        $tickettype->name           = 'Dagticket - Zondag';
        $tickettype->description    = 'Camping + Parking + Pendelbus Inbegrepen';
        $tickettype->festival_id    = '2';
        $tickettype->price          = '75.00';
        $tickettype->save();

        $tickettype = new TicketType();
        $tickettype->name           = '5 Dagen Confort';
        $tickettype->description    = 'Camping Confort + Parking VIP + Pendelbus Inbegrepen';
        $tickettype->festival_id    = '2';
        $tickettype->price          = '280.00';
        $tickettype->save();

        $tickettype = new TicketType();
        $tickettype->name           = 'Dagticket - Confort';
        $tickettype->description    = 'Camping Confort + Parking VIP + Pendelbus Inbegrepen. Openingsuren en toegang tot festival: Een dag naar keuze, vanaf 12u, tot volgende dag 11u.';
        $tickettype->festival_id    = '2';
        $tickettype->price          = '150.00';
        $tickettype->save();

        // Laundy day
        $tickettype = new TicketType();
        $tickettype->name           = 'WAVE 2';
        $tickettype->description    = '€35.00 + €3.75 service costs';
        $tickettype->festival_id    = '3';
        $tickettype->price          = '35.00';
        $tickettype->save();

        $tickettype = new TicketType();
        $tickettype->name           = 'WAVE 3';
        $tickettype->description    = '€39.00 + €3.75 service costs';
        $tickettype->festival_id    = '3';
        $tickettype->price          = '39.00';
        $tickettype->save();

        $tickettype = new TicketType();
        $tickettype->name           = 'Parking';
        $tickettype->description    = '€10.00 + €3.75 service costs';
        $tickettype->festival_id    = '3';
        $tickettype->price          = '10.00';
        $tickettype->save();

        $tickettype = new TicketType();
        $tickettype->name           = 'STARDUST VIP';
        $tickettype->description    = 'This ticket gives access to the festival and VIP area for one person on Saturday September 1. Included in this ticket: access to the VIP area, separate VIP entrance, bar, restaurant, toilets (food and drinks not included)';
        $tickettype->festival_id    = '3';
        $tickettype->price          = '89.00';
        $tickettype->save();

        //Graspop

        $tickettype = new TicketType();
        $tickettype->name           = 'Combi XL';
        $tickettype->description    = '21-24 juni';
        $tickettype->festival_id    = '4';
        $tickettype->price          = '245.00';
        $tickettype->save();

        $tickettype = new TicketType();
        $tickettype->name           = 'Dagticket - Donderdag';
        $tickettype->description    = '21 juni';
        $tickettype->festival_id    = '4';
        $tickettype->price          = '89.00';
        $tickettype->save();

        $tickettype = new TicketType();
        $tickettype->name           = 'Dagticket - Vrijdag';
        $tickettype->description    = '22 juni';
        $tickettype->festival_id    = '4';
        $tickettype->price          = '99.00';
        $tickettype->save();

        $tickettype = new TicketType();
        $tickettype->name           = 'Dagticket - Zaterdag';
        $tickettype->description    = '23 juni';
        $tickettype->festival_id    = '4';
        $tickettype->price          = '99.00';
        $tickettype->save();

        $tickettype = new TicketType();
        $tickettype->name           = 'Dagticket - Zondag';
        $tickettype->description    = '24 juni';
        $tickettype->festival_id    = '4';
        $tickettype->price          = '99.00';
        $tickettype->save();

        $tickettype = new TicketType();
        $tickettype->name           = 'VIP Combi';
        $tickettype->description    = '23 juni';
        $tickettype->festival_id    = '4';
        $tickettype->price          = '99.00';
        $tickettype->save();

        $tickettype = new TicketType();
        $tickettype->name           = 'Dagticket - VIP Donderdag';
        $tickettype->description    = '21 juni';
        $tickettype->festival_id    = '4';
        $tickettype->price          = '169.00';
        $tickettype->save();

        $tickettype = new TicketType();
        $tickettype->name           = 'Dagticket - VIP Vrijdag';
        $tickettype->description    = '22 juni';
        $tickettype->festival_id    = '4';
        $tickettype->price          = '169.00';
        $tickettype->save();

        $tickettype = new TicketType();
        $tickettype->name           = 'Dagticket - VIP Zaterdag';
        $tickettype->description    = '23 juni';
        $tickettype->festival_id    = '4';
        $tickettype->price          = '169.00';
        $tickettype->save();

        $tickettype = new TicketType();
        $tickettype->name           = 'VIP Zondag';
        $tickettype->description    = '24 juni';
        $tickettype->festival_id    = '4';
        $tickettype->price          = '169.00';
        $tickettype->save();

        $tickettype = new TicketType();
        $tickettype->name           = '20 GMM-munten';
        $tickettype->description    = '';
        $tickettype->festival_id    = '4';
        $tickettype->price          = '50.00';
        $tickettype->save();

        // Suikerrock
        $tickettype = new TicketType();
        $tickettype->name           = 'Combi ticket';
        $tickettype->description    = '3 dagen';
        $tickettype->festival_id    = '5';
        $tickettype->price          = '115.00';
        $tickettype->save();

        $tickettype = new TicketType();
        $tickettype->name           = 'Dagticket - Vrijdag';
        $tickettype->description    = '27 juli';
        $tickettype->festival_id    = '5';
        $tickettype->price          = '49.00';
        $tickettype->save();

        $tickettype = new TicketType();
        $tickettype->name           = 'Dagticket - Vrijdag - Kids';
        $tickettype->description    = '27 juli, 6 t/m 12j';
        $tickettype->festival_id    = '5';
        $tickettype->price          = '15.00';
        $tickettype->save();

        $tickettype = new TicketType();
        $tickettype->name           = 'Dagticket - Zaterdag';
        $tickettype->description    = '28 juli';
        $tickettype->festival_id    = '5';
        $tickettype->price          = '49.00';
        $tickettype->save();

        $tickettype = new TicketType();
        $tickettype->name           = 'Dagticket - Zaterdag - Kids';
        $tickettype->description    = '28 juli, 6 t/m 12j';
        $tickettype->festival_id    = '5';
        $tickettype->price          = '15.00';
        $tickettype->save();

        $tickettype = new TicketType();
        $tickettype->name           = 'Dagticket - Zondag';
        $tickettype->description    = '29 juli';
        $tickettype->festival_id    = '5';
        $tickettype->price          = '49.00';
        $tickettype->save();

        $tickettype = new TicketType();
        $tickettype->name           = 'Dagticket - Zondag - Kids';
        $tickettype->description    = '29 juli, 6 t/m 12j';
        $tickettype->festival_id    = '5';
        $tickettype->price          = '15.00';
        $tickettype->save();

        $tickettype = new TicketType();
        $tickettype->name           = 'Dagticket - Zondag - Family';
        $tickettype->description    = '29 juli';
        $tickettype->festival_id    = '5';
        $tickettype->price          = '115.00';
        $tickettype->save();

        $tickettype = new TicketType();
        $tickettype->name           = 'Drinks/Food';
        $tickettype->description    = '';
        $tickettype->festival_id    = '5';
        $tickettype->price          = '25.00';
        $tickettype->save();*/
    }
}

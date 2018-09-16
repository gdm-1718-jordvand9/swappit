<?php

use Illuminate\Database\Seeder;
use App\Festival;

class FestivalsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Pukkelpop
        $festival                   = new Festival();
        $festival->name             = 'Pukkelpop';
        $festival->slug             = str_slug($festival->name,'-');
        $festival->place            = 'Kiewit';
        $festival->description      = 'Pukkelpop is een jaarlijks terugkerend Belgisch muziekfestival in Kiewit, Hasselt. Het festival vindt traditioneel plaats in de tweede helft van augustus en duurde tot 2014 drie dagen. In 2015 werd het een vierdaags festival. Het festival wordt georganiseerd door The Factory vzw van onder anderen Chokri Mahassine.';
        $festival->start_date       = '2018-08-15';
        $festival->end_date         = '2018-08-18';
        $festival->facebook_url     = 'https://www.facebook.com/pukkelpop';
        $festival->twitter_url      = 'https://twitter.com/pukkelpop';
        $festival->instagram_url    = 'https://www.instagram.com/pukkelpop/';
        $festival->snapchat_url     = 'https://www.snapchat.com/add/pkpfestival';
        $festival->save();

        //Dour
        $festival                   = new Festival();
        $festival->name             = 'Dour';
        $festival->slug             = str_slug($festival->name,'-');
        $festival->place            = 'Dour';
        $festival->description      = 'Het Dour Festival of kortweg Dour is een vijfdaags muziekfestival dat zichzelf de naam van \'European Alternative Music Event\' geeft. Het vindt sinds 1989 ieder jaar plaats bij het Waalse dorp Dour. ';
        $festival->start_date       = '2018-07-11';
        $festival->end_date         = '2018-07-15';
        $festival->facebook_url     = 'https://www.facebook.com/dourfestival';
        $festival->twitter_url      = 'https://twitter.com/dourfestival';
        $festival->instagram_url    = 'https://www.instagram.com/dourfestival/';
        $festival->snapchat_url     = 'https://www.snapchat.com/add/dourfestival';
        $festival->save();

        //Laundy Day
        $festival                   = new Festival();
        $festival->name             = 'Laundry Day';
        $festival->slug             = str_slug($festival->name,'-');
        $festival->place            = 'Antwerpen';
        $festival->description      = 'Laundry Day is een Belgisch dancefestival in Antwerpen. Het festival ontstond in 1998 in de Antwerpse Kammenstraat. Het wordt elk jaar op de eerste zaterdag van september gehouden en is één van de laatste festivals van de Belgische festivalzomer.';
        $festival->start_date       = '2018-09-01';
        $festival->end_date         = '2018-09-01';
        $festival->facebook_url     = 'https://www.facebook.com/laundryday';
        $festival->twitter_url      = 'https://twitter.com/laundrydayevent';
        $festival->instagram_url    = 'https://www.instagram.com/laundryday_antwerp/';
        $festival->save();

        //Graspop
        $festival                   = new Festival();
        $festival->name             = 'Graspop';
        $festival->slug             = str_slug($festival->name,'-');
        $festival->place            = 'Dessel';
        $festival->description      = 'Graspop Metal Meeting is een jaarlijks meerdaags metalfestival in Dessel, in de Belgische provincie Antwerpen. Sinds 2008 trekt het festival elk jaar rond de 135.000 bezoekers.';
        $festival->start_date       = '2018-06-21';
        $festival->end_date         = '2018-06-24';
        $festival->facebook_url     = 'https://www.facebook.com/graspop';
        $festival->twitter_url      = 'https://twitter.com/GraspopMetal';
        $festival->instagram_url    = 'https://www.instagram.com/graspopmetalmeeting/';
        $festival->save();

        //Suikerrock
        $festival                   = new Festival();
        $festival->name             = 'Suikerrock';
        $festival->slug             = str_slug($festival->name,'-');
        $festival->place            = 'Tienen';
        $festival->description      = 'Suikerrock is een Belgisch muziekfestival, in de binnenstad van Tienen. De naam is ontleend aan de "suikerstad" Tienen: hier ligt namelijk de belangrijkste suikerraffinaderij van België. Suikerrock is ontstaan in 1986.';
        $festival->start_date       = '2018-07-27';
        $festival->end_date         = '2018-07-29';
        $festival->facebook_url     = 'https://www.facebook.com/suikerrock';
        $festival->twitter_url      = 'https://twitter.com/suikerrock';
        $festival->instagram_url    = 'https://www.instagram.com/suikerrock/';
        $festival->save();
    }
}

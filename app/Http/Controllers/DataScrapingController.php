<?php

namespace App\Http\Controllers;

use App\Models\DataScraping;
use Illuminate\Http\Request;
use Goutte\Client;

class DataScrapingController extends Controller
{
    public function index()
    {
        $client = new Client();
        $crawler = $client->request('GET', '');
        // dd($crawler);
        $json_object = '';
        $test = $crawler->filter('a.js-navigation-open')->each(function ($node) {
            return ($node->attr('href'));
        });
        // dd($test);
        $i = 0;
        $j = 0;
        foreach ($test as $t) {
            if ($j == 20) {
                // var_dump($test[$i]);
                $this->specific_scraper_tremblay($test[$i]);
            }
            $i++;
            $j++;
        }
    }

    public function specific_scraper_tremblay($link)
    {
        $client = new Client();

        $crawler = $client->request('GET', 'https://github.com' .  $link);
        // dd($crawler);
        $test = $crawler->filter('td')->each(function ($node) {
            return ($node->text());
        });
        // dd($test);
        $y = implode(",", $test);
        // dd($y);


        $name_temp = explode(",{,,\"name\": \"", $y);
        // dd($name_temp[0]);
        $name = explode(",,,\"ty", $name_temp[1]);
        // dd($name[1]);
        $name_var = $name[0];
        // dd($name_var);

        $type_temp = explode("pe\": \"", $name[1]);
        // dd($type_temp[1]);
        $type = explode(",,,\"desc", $type_temp[1]);
        // dd($type[1]);
        $type_var = $type[0];
        // dd($name_var);

        $description_temp = explode("ription\": \"", $type[1]);
        // dd($description_temp[0]);
        $description = explode(",,,\"key", $description_temp[1]);
        // dd($description[1]);
        $description_var = $description[0];
        // dd($description_var);

        $licence_temp = explode("license\": \"", $description[1]);
        // dd($licence_temp[0]);
        $licence = explode(",,,\"require-d", $licence_temp[1]);
        // dd($licence[1]);
        $licence_var = $licence[0];
        // dd($licence_var);

        $require_temp = explode("ev\": {,,\"", $licence[1]);
        // dd($require_temp[1]);
        $require = explode(",,},,,\"autoload", $require_temp[1]);
        // dd($require[0]);
        $require_var = $require[0];
        // dd($require_var);

        $faker_temp = explode("fakerphp/faker\": \"", $require[0]);
        dd($faker_temp[1]);
        $licence = explode(",,,\"require-d", $faker_temp[1]);
        // dd($licence[1]);
        $licence_var = $licence[0];
        // dd($licence_var);


    }
}
<?php

require_once "requests_helper.php";

class Tools
{
       public function httpget($url)
    {

                Requests::register_autoloader();


                $response = Requests::get($url);

                return $response->body;

   }
}
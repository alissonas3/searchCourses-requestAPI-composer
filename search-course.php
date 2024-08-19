<?php

require 'vendor/autoload.php';
require 'src/Search.php';

use Alura\SearchCourses\Search;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

$client = new Client(['verify' => false, 'base_uri' => 'https://www.alura.com.br/']);
$crawler = new Crawler();

$searchFrom = new Search($client, $crawler);
$courses = $searchFrom->searchCourses('cursos-online-programacao/dotnet');

foreach ($courses as $course) {
    echo $course . PHP_EOL;
}
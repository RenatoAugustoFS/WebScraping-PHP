<?php

require "vendor/autoload.php";

use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;
use Alura\WebScraping\AluraCoursesFinder;

ClassMapTest::test();

$client = new Client(['base_uri' => 'https://www.alura.com.br/']);
$crawler = new Crawler();

$coursesFinder = new AluraCoursesFinder($client, $crawler);
$url = '/formacao-arquiteto-php';
$tagHtml = 'p.formacao-passo-nome';

$courses = $coursesFinder->find($url, $tagHtml);

foreach ($courses as $course){
    exibeMensagem($course);
}
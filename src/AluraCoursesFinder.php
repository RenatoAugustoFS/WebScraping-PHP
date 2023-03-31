<?php

namespace Alura\WebScraping;

use GuzzleHttp\ClientInterface;
use Symfony\Component\DomCrawler\Crawler;

class AluraCoursesFinder
{
    private ClientInterface $client;

    private Crawler $crawler;

    public function __construct(ClientInterface $client, Crawler $crawler)
    {
        $this->client = $client;
        $this->crawler = $crawler;
    }

    public function find(string $url): array
    {
        $response = $this->client->request('GET', $url);
        $html = $response->getBody();
        $this->crawler->addHtmlContent(
            $html);
        $courses = $this->crawler->filter('p.formacao-passo-nome');
        $coursesList = [];
        foreach ($courses as $course) {
            $coursesList[] = $course->textContent;
        }
        return $coursesList;
    }
}

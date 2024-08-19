<?php

namespace Alura\SearchCourses;

use GuzzleHttp\ClientInterface;
use Symfony\Component\DomCrawler\Crawler;

class Search
{
    /**
     * @var ClientInterface
     */
    private $httpClient;
    /**
     * @var Crawler
     */
    private $crawler;

    public function __construct(ClientInterface $httpClient, Crawler $crawler)
    {
        $this->httpClient = $httpClient;
        $this->crawler = $crawler;
    }

    public function searchCourses(string $url): array
    {
        $response = $this->httpClient->request('GET', $url);

        $html = $response->getBody();
        $this->crawler->addHtmlContent($html);

        $coursesElement = $this->crawler->filter('span.card-curso__nome');
        $courses = [];

        foreach ($coursesElement as $elements) {
            $courses[] = $elements->textContent;
        }

        return $courses;
    }
}
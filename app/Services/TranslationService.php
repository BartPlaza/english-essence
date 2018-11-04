<?php

namespace App\Services;

use GuzzleHttp\Client as Guzzle;

class TranslationService
{
    /**
     * @var Guzzle
     */
    private $guzzle;
    private $baseEndpoint;

    public function __construct(Guzzle $guzzle)
    {
        $this->guzzle = $guzzle;
        $this->baseEndpoint = 'https://api-platform.systran.net/translation/text/translate?key=' . config('services.systran.key');
    }

    public function translateAll(array $words, string $from, string $to)
    {
        $endpoint = $this->baseEndpoint . '&target=' . $to . '&source=' . $from;
        foreach ($words as $word){
            $endpoint = $endpoint . '&input=' . $word;
        }
        $this->getRequest($endpoint);
    }

    private function getRequest(string $endpoint)
    {
        return $this->guzzle->get($endpoint)->getBody();
    }
}
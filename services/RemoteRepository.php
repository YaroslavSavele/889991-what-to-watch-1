<?php

namespace services;

class RemoteRepository
{
    private $httpClient;

    public function __construct(\Psr\Http\Client\ClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }


    public function getMovie(string $imdbId, string $apikey)
    {
        $response = $this->httpClient->request('GET', '?i=' . $imdbId . '&apikey=' . $apikey);

        return json_decode($response->getBody()->getContents(), true);
    }
}

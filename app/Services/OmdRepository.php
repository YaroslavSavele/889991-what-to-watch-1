<?php

namespace App\Services;

use GuzzleHttp\Client;

class OmdRepository implements InterfaceMovieRepository
{
    private string $apikey = '287ffaab';
    private string $imdbId;

    public function __construct($imdbId)
    {
        $this->imdbId = $imdbId;
    }

    public function getMovie()
    {
        $client = new Client(['base_uri' => 'http://www.omdbapi.com']);
        $response = $client->request('GET', '?i=' . $this->imdbId . '&apikey=' . $this->apikey);

        return json_decode($response->getBody()->getContents(), true);
    }
}

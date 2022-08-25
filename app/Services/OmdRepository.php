<?php

namespace App\Services;

use GuzzleHttp\Client;

class OmdRepository implements InterfaceMovieRepository
{
    private string $apikey = '287ffaab';

    public function getMovie($imdbId)
    {
        $client = new Client(['base_uri' => 'http://www.omdbapi.com']);
        $response = $client->request('GET', '?i=' . $imdbId . '&apikey=' . $this->apikey);

        return json_decode($response->getBody()->getContents(), true);
    }
}

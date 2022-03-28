<?php

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class MovieApiDto{
    private $client;
    private const API_KEY3 = "f6caa152f0578a89393898249a56a9c7";
    private const API_KEY4 = "eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJmNmNhYTE1MmYwNTc4YTg5MzkzODk4MjQ5YTU2YTljNyIsInN1YiI6IjYyM2RiN2FmN2NmZmRhMDA0Nzc3NDEzNCIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.qi-aH-E7iHAA-X5To-RM5vNIemuoYR2me5NeIOslqr8";

    public function __construct(){
        $this->setClient(HttpClient::create());
    }


    public function getFilmsByName($nomFilm):stdClass
    {
        $response = $this->client->request(
            'GET',
            'https://api.themoviedb.org/3/search/movie?api_key='.MovieApiDto::API_KEY3.'&query='.$nomFilm,
        );
        
        //Pour l'afficher :
//        {% for result in films.results  %}
//        <a>{{ result.original_title }}</a>
//          <a>{{ result.id }}</a><br>
//          {% endfor %}
        $content = json_decode($response->getContent());
        return $content;
    }


    public function getFilmById($id):stdClass
    {
        $response = $this->client->request(
          'GET',
            'https://api.themoviedb.org/3/movie/'.$id.'?api_key='.MovieApiDto::API_KEY3
        );
//        <h1>{{ film.original_title }}</h1>
//    <a>{{ film.overview }}</a>
        return json_decode($response->getContent());
    }

    public function getImageFromName($imageUrl): string{
        return 'https://image.tmdb.org/t/p/original'.$imageUrl;
    }


    /**
     * @param mixed $client
     */
    public function setClient($client): void
    {
        $this->client = $client;
    }
}
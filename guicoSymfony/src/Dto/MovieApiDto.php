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
            'https://api.themoviedb.org/3/search/movie?api_key='.MovieApiDto::API_KEY3.'&query='.$nomFilm.'&language=fr',
        );
        $content = json_decode($response->getContent());
        return $content;
    }

    public function getFilmById($id):stdClass
    {
        $response = $this->client->request(
          'GET',
            'https://api.themoviedb.org/3/movie/'.$id.'?api_key='.MovieApiDto::API_KEY3.'&language=fr'
        );
        return json_decode($response->getContent());
    }
    public function getFilmByCategoryId($id, $nbElements, bool $adultContentEnabled = null): array
    {
        $index = 1;
        $filmsTab = array();
        //Faire la récup des films par popularité
        //Récupération du nombre d'éléments à afficher
        while(count($filmsTab) < $nbElements){
            //Récupération de tous les films populaires à l'index 1
            $tempFilmList = $this->getPopular($index);
            //On récuère chaque film de la liste
            foreach($tempFilmList->results as $film){
                //Récupération de chaque catégorie de film
                //DD($film);
                foreach($film->genre_ids as $filmGenre){
                    //Si la catégorie correspond à la catégorie filtrée
                    if($filmGenre == $id && $film->adult == $adultContentEnabled){
                        //Push dans le tableau
                        array_push($filmsTab,$film);
                    }
                    if(count($filmsTab) == $nbElements){
                        //On met le return ici parce que j'ai envie
                        return $filmsTab;
                    }
                }
            }
            $index++;
        }
        return $filmsTab;
    }

    public function getImageFromName($imageUrl): string{
        return 'https://image.tmdb.org/t/p/original'.$imageUrl;
    }

    //Page au maximum 500
    //Ne pas dire que ce sont les films les plus populaires (Car on va ajouter notre propre système de notation
    //Donc il y aura surement une page avec "Les plus populaires" selon notre système de notation
    public function getPopular($page): stdClass
    {
         $response = $this->client->request(
           'GET',
           'https://api.themoviedb.org/3/movie/popular?api_key='.MovieApiDto::API_KEY3.'&page='.$page.'&language=fr',
         );
         return json_decode($response->getContent());
    }

    public function getFilmAdultContentFiltered($nbElements, $adultContentEnabled):array
    {
        $index = 1;
        $filmsTab = array();
        //Faire la récup des films par popularité
        //Récupération du nombre d'éléments à afficher
        while(count($filmsTab) < $nbElements){
            //Récupération de tous les films populaires à l'index 1
            $tempFilmList = $this->getPopular($index);
            //On récuère chaque film de la liste
            foreach($tempFilmList->results as $film){
                //Récupération de chaque catégorie de film
                //DD($film);
                //Si la catégorie correspond à la catégorie filtrée
                //DD(boolval($film->adult));
                if( boolval($film->adult) == $adultContentEnabled){
                    //Push dans le tableau
                    array_push($filmsTab,$film);
                }
                if(count($filmsTab) == $nbElements){
                    //DD($filmsTab);

                    //On met le return ici parce que j'ai envie
                    return $filmsTab;
                }
            }
            $index++;
        }
        return $filmsTab;
    }

    public function getCategories():stdClass
    {
        $response = $this->client->request(
            'GET',
            'https://api.themoviedb.org/3/genre/movie/list?api_key='.MovieApiDto::API_KEY3.'&language=fr',
        );
        return json_decode($response->getContent());
    }

    /**
     * @param mixed $client
     */
    public function setClient($client): void
    {
        $this->client = $client;
    }
}
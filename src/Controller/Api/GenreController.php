<?php

namespace App\Controller\Api;

use App\Entity\Genre;
use App\Repository\GenreRepository;
use App\Repository\MovieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GenreController extends AbstractController
{
// Ici /api/genre c'est le endpoint, c'est la route mais dans l'univers API c'est comme ca que ca s'appelle
    // Le endpoint est concaténé avec l'url de base
    // Ca donne : http://localhost/promos/falafel/repo/oflix/public/api/genre
    // Cette methode sera accessible en methode GET
    #[Route('api/genres', name: 'get_genres', methods: ['GET'])]
    public function list(GenreRepository $genreRepository)
    {
        // Je recupere tous les films
        $genres = $genreRepository->findAll();
        return $this->json(
            // 1er parametres = ce qu'on veut afficher
            $genres,
            // 2eme parametre : le code status
            // voir liste des code status : https://en.wikipedia.org/wiki/List_of_HTTP_status_codes
            200,
            // 3eme parametre = le header
            [''],
            // 4eme parametre : le/les groupe(s)
            // Les groupes permettent de définir quels éléments de l'entité on veut afficher
            ['groups' => 'get_genres']
        );
    }
    #[Route('api/genre/{id}', name: 'get_genre_id', methods: ['GET'])]
    public function show(GenreRepository $genreRepository, $id)
    {
        // Je recupere tous les films
        $genre = $genreRepository->find($id);
        
        return $this->json(
            // 1er parametres = ce qu'on veut afficher
            $genre,
            200,
            [],
            ['groups' => 'get_genres']
        );
    }

    //ICI ON CRÉER UNE ROUTE QUI VIENT CHERCHER LES FILMS EN FONCTION DE LEUR GENRE
    
    #[Route('api/genres/{id}/movies', name: 'get_movieByGenre_id', methods: ['GET'])]
    public function moviesByGenres(GenreRepository $genreRepository, $id, MovieRepository $movieRepository)
    {
        // Je recupere le genre
        $movieByGenre = $genreRepository->findMoviesByGenre($id);
        dump($movieByGenre);
        return $this->json(
            $movieByGenre,
            200,
            [],
            ['groups' => 'get_movies']
        );
    }
}

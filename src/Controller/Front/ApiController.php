<?php

namespace App\Controller\Front;

use App\Model\Movies;
use App\Repository\MovieRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ApiController extends AbstractController
{
    /**
     * Route d'api qui affiche tous les films au format JSON
     *
     * @return JSON
     */
    #[Route('/api/movies', name: 'api_get_movies', methods:['GET'])]
    public function index(MovieRepository $movieRepository): Response
    {
        // Etape 1 : On recupere tous les films et on les stock dans $movies
        $movies = $movieRepository->findAll();
        // Etape 2 : On retourne les films ... au format JSON car on est dans une api
        // La methode json ci dessous est presente dans le AbstractController, c'est une méthode offerte par symfony qui permet de jsonifier un tableau associatif php
        // En d'autres termes : il convertit un tableau php en json
        // "prenom" => "imed" // php
        // "prenom":"imed" // JSON
        // Voir : https://symfony.com/doc/current/controller.html#returning-json-response
        return $this->json(
            // 1er parametres = ce qu'on veut afficher
            $movies,
            // 2eme parametre : le code status
            // voir liste des code status : https://en.wikipedia.org/wiki/List_of_HTTP_status_codes
            200,
            // 3eme parametre = le header
            [],
            // 4eme parametre : le/les groupe(s)
            // Les groupes permettent de définir quels éléments de l'entité on veut afficher
            ['groups' => 'movie_collection']
        );
    }
}

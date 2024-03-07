<?php

namespace App\Controller\Api;

use App\Entity\Movie;
use App\Form\MovieType;
use App\Repository\MovieRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

class MovieController extends AbstractController
{
    // Ici /api/movie c'est le endpoint, c'est la route mais dans l'univers API c'est comme ca que ca s'appelle
    // Le endpoint est concaténé avec l'url de base
    // Ca donne : http://localhost/promos/falafel/repo/oflix/public/api/movie
    // Cette methode sera accessible en methode GET
    #[Route('api/movies', name: 'get_movies', methods: ['GET'])]
    public function list(MovieRepository $movieRepository)
    {
        // Je recupere tous les films
        $movies = $movieRepository->findAll();
        // La fonction json ci dessous est dans la classe parente AbstractController
        // La méthode $this->json permet de convertir un objet PHP en JSON
        // On dit qu'on serialise (serialiser => convertir un objet PHP en JSON ou en autre format)
        // doc : https://symfony.com/doc/current/controller.html#returning-json-response
        // Elle prend plusieurs parametre:
        // 1er = les données qu'on veut envoyer au format JSON
        // 2eme = status code (liste : https://en.wikipedia.org/wiki/List_of_HTTP_status_codes)
        // 3eme = le header de la reponse 
        // 4eme = les groupes ..
        return $this->json(
            // 1er parametres = ce qu'on veut afficher
            $movies,
            // 2eme parametre : le code status
            // voir liste des code status : https://en.wikipedia.org/wiki/List_of_HTTP_status_codes
            200,
            // 3eme parametre = le header
            [''],
            // 4eme parametre : le/les groupe(s)
            // Les groupes permettent de définir quels éléments de l'entité on veut afficher
            ['groups' => 'get_movies']
        );
    }
    #[Route('api/movies/{id}', name: 'get_movie_id', methods: ['GET'])]
    public function show(MovieRepository $movieRepository, $id)
    {
        // Je recupere tous les films
        $movie = $movieRepository->find($id);
        
        return $this->json(
            // 1er parametres = ce qu'on veut afficher
            $movie,
            200,
            [],
            ['groups' => 'get_movies']
        );
    }



    #[Route('api/movies/random', name: 'get_movie_random', methods: ['GET'])]
    public function random(MovieRepository $movieRepository)
    {
        // Je recupere tous les films
        $movie = $movieRepository->getRandomMovie();
        
        return $this->json(
            // 1er parametres = ce qu'on veut afficher
            $movie,
            200,
            [],
            ['groups' => 'get_movies']
        );
    }
    #[Route('api/movies/{id}', name: 'get_movie_id', methods: ['DELETE'])]
    public function delete(MovieRepository $movieRepository, $id, EntityManagerInterface $entityManager)
    {
        // Je recupere le genre
        $movie = $movieRepository->find($id);
        $entityManager->remove($movie);
        $entityManager->flush();

        return $this->json(
            // 1er parametres = ce qu'on veut afficher
            $movie,
            200,
            ['Film supprimé'],
            ['groups' => 'get_movies']
        );
    }
    /**
     * Créer un film via un formulaire envoyé en JSON
     *
     * @return Response
     */
    #[Route('api/movies', name: 'api_add_movie', methods: ['POST'])]
    public function create(Request $request, EntityManagerInterface $entityManager, SerializerInterface $serializer): Response
    {
        $content = $request->getContent();
        $movie = $serializer->deserialize($content, Movie::class, 'json');   
        /*
        // on récup les données json de la requête
        $data = json_decode($request->getContent(), true);
        // on crée une nvelle instance avec les données
        $movie = new Movie();
        $movie->setTitle($data['title']);
        $movie->setDuration($data['duration']);
        $movie->setReleaseDate(new \DateTime($data['releaseDate']));
        $movie->setSynopsis($data['synopsis']);
        $movie->setSummary($data['summary']);
        $movie->setType($data['type']);
        $movie->setRating($data['rating']);
        */
        // on enregistre dans la BDD
        $entityManager->persist($movie);
        $entityManager->flush();

        // on retourne le code JSON avec le nveau film et le code de la requete
        return $this->json($movie, 201, [], ['groups' => 'get_movies']);
    }

    #[Route('api/movies/{id}', name: 'api_update_movie', methods: ['PUT'])]
    public function update(Request $request, EntityManagerInterface $entityManager, SerializerInterface $serializer, $id): Response
    {
        $content = $request->getContent();
        $movie = $serializer->deserialize($content, Movie::class, 'json');
/*
        // on récup les données json de la requête
        $data = json_decode($request->getContent(), true);
        // on crée une nvelle instance avec les données
        $movie = new Movie();
        $movie->setTitle($data['title']);
        $movie->setDuration($data['duration']);
        $movie->setReleaseDate(new \DateTime($data['releaseDate']));
        $movie->setSynopsis($data['synopsis']);
        $movie->setSummary($data['summary']);
        $movie->setType($data['type']);
        $movie->setRating($data['rating']);
*/
        // on enregistre dans la BDD
        $entityManager->persist($movie);
        $entityManager->flush();

        // on retourne le code JSON avec le nveau film et le code de la requete
        return $this->json($movie, 201, [], ['groups' => 'get_movies']);
    }
}

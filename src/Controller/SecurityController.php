<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * Page de Login
     */
    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // L'objet $authenticationUtils nous permet d'avoir des informations sur l'authentification
        // C'est un peu le meme délire que l'objet Request $request
        // On avait besoin de $request pour avoir des informations sur la requête
        // Et la on a besoin de $authenticationUtils pour avoir des informations sur l'authentification

        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        // On stock dans $error le message d'erreur si il y a une erreur quand on se connecte (user inexistant, mauvais mdp, etc)
        $error = $authenticationUtils->getLastAuthenticationError(); // Sert a récupérer le dernier message d'erreur
        // last username entered by the user
        // On stock dans $lastUsername le dernier username entré (ici notre identifiant de connexion c'est l'email)
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error
        ]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}

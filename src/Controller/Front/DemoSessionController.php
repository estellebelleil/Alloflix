<?php

namespace App\Controller\Front;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mailer\MailerInterface;

class DemoSessionController extends AbstractController
{
    #[Route('/email')]
    public function sendEmail(MailerInterface $mailer): Response
    {
        $email = (new Email())
            ->from('hello@example.com')
            ->to('you@example.com')
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Time for Symfony Mailer!')
            ->text('Sending emails is fun again!')
            ->html('<p>See Twig integration for better HTML integration!</p>');

        $mailer->send($email);
        dd('fait');

        // ...
    }

    /**
     * Vue qui affiche les données de la session
     *
     * @param Request $request
     * @return void
     */
    #[Route('/demo/session', name: 'demo_session_index')]
    public function index(Request $request)
    {
        // 4eme étape: on Recupere la session
        // Ci dessous je recupere toute la session et je la stock dans $session
        $session = $request->getSession();
        // 5eme étape: on recupere l'element dans la session qui a pour clé "username"
        // Ci dessous je récupere l'element qui a pour clé "username" dans ma session
        $username = $session->get('username');
        dump($username);
        dump('toto');
        return $this->render('front/demo_session/index.html.twig', [
            'username' => $username
        ]);
    }

    /**
     * Fonction qui ajoute un element dans la session
     *
     * @return void
     */
    #[Route('/demo/session/add/{username}', name: 'demo_session_add')]
    public function add(Request $request, $username)
    {
        // 1ere étape: Récupérer la session
        $session = $request->getSession();

        // 2eme étape: Ajouter une donnée dans la session
        // Voyez la session comme un grand tableau associatif ou on va avoir des clés => valeurs associés
        // Pour ajouter une donnée dans la session, on utilise set() qui prend 2 parametre :
        // 1er param : la clé ici username
        // 2eme param : la valeur associé à la clé (du 1er param), ici toto 
        $session->set('username', $username);

        // 3eme étape: Je vais redirigier l'utilisateur sur la route de la méthode index (plus haut)
        return $this->redirectToRoute("demo_session_index");
    }

    /**
     * Vue qui affiche les données de la session
     *
     * @param Request $request
     * @return void
     */
    #[Route('/demo/session/mail', name: 'demo_session_index_mail')]
    public function maail(Request $request)
    {
        $email = (new Email())
        // email address as a simple string
        ->from('fabien@example.com')

        // email address as an object
        ->from(new Address('fabien@example.com'))

        // defining the email address and name as an object
        // (email clients will display the name)
        ->from(new Address('fabien@example.com', 'Fabien'))

        // defining the email address and name as a string
        // (the format must match: 'Name <email@example.com>')
        ->from(Address::create('Fabien Potencier <fabien@example.com>'));
        dd('ok');
    }
}

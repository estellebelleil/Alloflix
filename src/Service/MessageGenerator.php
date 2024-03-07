<?php
// src/Service/MessageGenerator.php
namespace App\Service;

class MessageGenerator
{
    /**
     * Fonction qui retourne une citation de Kaamelott au hasard
     *
     * @return string
     */
    public function getRandomMessage(): string
    {
        // Liste de 3 citations de Kaamelott
        // Voir : https://www.kaakook.fr/film-1343
        $messages = [
            '«Tu vois, le monde se divise en deux catégories: ceux qui ont un pistolet chargé et ceux qui creusent. Toi tu creuses.»
            (Le bon, la brute et le truand)',
            '« Mais tu ne comprends pas (…) je suis un homme !
            -Et alors, personne n’est parfait ! »
            (Certains l’aiment chaud)',
            ' « Allo McFly, y’a personne au bout du fil ! Faut réfléchir McFLy ! » (Retour vers le futur)',
            '«Les cons ça ose tout. C’est même à ça qu’on les reconnait. » (Les tontons flingueurs)'
        ];
        // $index sera egal a index aléatoire dans le tableau $messages
        $index = array_rand($messages);
        // On retourne le message qui apour index $index
        return $messages[$index];
    }
}
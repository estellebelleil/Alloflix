# Bienvenue sur le projet backend d'Alloflix
Ici vous trouverez le guide d'installation du projet Alloflix ainsi que le récapitulatif des fonctionnalités mises en place dans l'application. Partant d'un simple exercice et d'une interface visuelle pré-existante, le projet s'est vite avéré être un terrain de jeu pour expérimenter diverses fonctionnalités de PHP et de concrétiser un projet en presque totalité avec Symfony, son ORM Doctrine et Twig.

### Installation du projet

Créer un fichier .env depuis le modèle .envExemple

Ajouter les informations liées à votre bdd dans la section DATABASE_URL : 
```
DATABASE_URL="mysql://app:!ChangeMe!@127.0.0.1:3306/app?serverVersion=10.11.2-MariaDB&charset=utf8mb4"
```

Puis lancer le composer : 
```
composer install
```

## Fonctionnalités 

Tables et bdd : 

=> ```src/Repository```

=> ```src/Entity```

=> ```migrations```

API et serialization => ```src/Controller/Api```

BackOffice => ```src/Controller/BackOffice```

Authentification et tokens:

=> ```src/Controller/SecurityController```

=> ```src/Security/LoginAuthenticator```

=> ```config/jwt```

=> ```config/packages/security.yaml```

=> ```config/routes.yaml```

Création des vues Twigs => ```templates```

Création des formulaires pour vues Twigs (côté BackOffice) => ```src/Form```

Création des services =>  ```src/Service```

Création des écouteurs d'évenements avec Symfony =>  ```src/EventListener```

Création des fixtures =>  ```src/DataFixtures```

## Envie d'en savoir plus sur mes projets et mon parcours ?

C'est par ici : [estellebelleil.github.io](https://estellebelleil.github.io " Portfolio - Estelle Belleil ")
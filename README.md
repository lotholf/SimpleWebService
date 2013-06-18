SimpleWebService
================
[![Build Status](https://travis-ci.org/lotholf/SimpleWebService.png?branch=master)](https://travis-ci.org/lotholf/SimpleWebService)

Il s'agit ici d'un projet permettant de prendre en main diverses technologies.
Le projet consiste en 2 applications communiquant l'une avec l'autre (architecture client/serveur).

La problèmatique du projet est simple : la sauvegarde de contacts (Informations associées : Nom, Prénom, Adresse email).
L'application Client permettra de saisir les informations requises et transmettra ensuite celles-ci à l'application Serveur afin que cette dernière l'enregistre.

Architecture
------------
Les deux applications communiquent à l'aide de requête HTTP au format JSON.

* **Application Serveur :**
Elle met à disposition une API permettant d'enregistrer un contact et de récupérer les contacts déjà enregistrés. 
Pour enregistrer un contact, il faut appeler l'url /contact avec la methode HTTP POST.
Pour récupérer les contacts enregistrés, il suffit de faire le même appel mais avec la méthode HTTP GET (et donc sans corps dans le message)
    
    Voici un exemple du corps de message en JSON pour enregistrer un contact :
    ```json
    {
        "lastname": "Wayne",
        "firstname": "Bruce",
        "mail":"batman@superheroes.com"
    }
    ```
    Si le message est correctement formé, le serveur retournera alors :
    ```json
    {
        "message": "Thank you for your data"
    }
    ```
    

* **Application Client :**
Elle met à disposition d'un utilisateur un simple formulaire permettant de saisir les informations d'un contact (Nom, prénom et email).
Elle est réalisé en silex à partir du [Silex-Skeleton](https://github.com/silexphp/Silex-Skeleton).
Afin de transmettre les informations vers l'application Serveur, on utilise la classe [RESTConnection](https://github.com/spocky/RESTConnection) développée par un ancien collègue.

Tests
-----
Des tests unitaires réalisés avec [atoum](https://github.com/atoum/atoum) sont mis en place du coté de l'application Serveur.
[Travis-CI](https://travis-ci.org) permet de voir la stabilité des tests à chaque changement sur le projet.


Bientôt, des tests fonctionnels seront mis en place coté Serveur et Client.

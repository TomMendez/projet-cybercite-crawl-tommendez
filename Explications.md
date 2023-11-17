# Projet Crawl Datagarden pour entretien technique Cybercite - Tom Mendez

Etapes pour la rélisation du projet :

-S'appuyer sur le code fourni pour créer une requete qui récupère la position du site sur google
--> Copie des fichiers à partir du git exemple, reste à mettre en forme pour l'ajout en BDD

-Concevoir puis créer une bdd mysql qui stocke ces positions avec leur date en respectant les contraintes (Doctrine)

-Réaliser le code interface avec la bdd (Doctrine avec objet ORM)

(-Dockeriser le projet, BDD de base voir pour le serveur php)

(-mise en place d'un linter)

(-mise en place de tests unitaires voir executer les tests lors des git push)

[Explciations Symfony et Doctrine + toutes les versions]

Le commit initial a été fait directement à paritr d'un projet symfony vide, voici les étapes suivies pour créer ce projet basique
Note : ces commandes sont a but purement informatif, aucune de ces commandes ne doit être exécutée.

**
Créer projet :
composer create-project symfony/skeleton:"6.3.*" projet-cybercite-crawl-tommendez
cd projet-cybercite-crawl-tommendez
composer require webapp

(Si bug : sudo apt install php-xml)


Setup ORM :
composer require symfony/orm-pack
composer require --dev symfony/maker-bundle
composer require doctrine


Modifier .env :
# to use mysql
DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name?serverVersion=5.7"
# [to use mariadb:]
DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name?serverVersion=mariadb-10.5.8"


Setup bdd docker :
./bin/console make:docker:database  
(choisir mysql [0])

sudo docker-compose up -d

[Pour se connecter directement à la BDD :]
sudo docker-compose exec database mysql --password

USE main;

(Arret des conteneurs : sudo docker-compose down)
**

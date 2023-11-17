# projet-datagarden-cybercite-tommendez

Etapes pour la rélisation du projet :

-S'appuyer sur le code fourni pour créer une requete qui récupère la position du site sur google
--> Copie des fichiers à partir du git exemple, reste à mettre en forme pour l'ajout en BDD

-Concevoir puis créer une bdd mysql qui stocke ces positions avec leur date en respectant les contraintes
-Réaliser le code interface avec la bdd (probablement symphony)
(-Dockeriser le projet, idéalement en séparant la BDD et le serveur php)
(-mise ne place d'un linter)
(-mise en place de tests unitaires voir executer les tests lors des git push)

Ne pas oublier de créer le fichier "Explications.md" (ou juste renommer le readme)


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
# to use mariadb:
DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name?serverVersion=mariadb-10.5.8"


Setup bdd docker :
./bin/console make:docker:database  
(choisir mysql [0])

sudo docker-compose up -d

sudo docker-compose exec database mysql --password

USE main;

(Arret des conteneurs : sudo docker-compose down)

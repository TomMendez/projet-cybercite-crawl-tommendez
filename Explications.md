# projet-datagarden-cybercite-tommendez
# Auteur : Tom Mendez (avec des ressources de Cybercite)

# Comment Utiliser l'application :
Pré-requis : PHP 7.4 ou supérieur / composer

- composer install
- sudo docker-compose up -d
- sudo symfony serve -d

Ensuite on peut accéder à la page Web Localhost (résultat de la commande "serve", probablement http://127.0.0.1:8000)

Le crawl est déclenché lorsqu'on charge la page /crawl et le résultat est affiché directement sur la page.

On peut aussi accéder à la base de données depuis la console pour voir les Crawls stockés :
sudo symfony console doctrine:query:sql 'SELECT * FROM crawl'

TODO : faire de /crawl la page d'acceuil *********************************


# Explication de la problématique et architecture du projet :
TODO


# Explications techniques et description du framework
Pour réaliser ce projet, j'ai utilisé le framework Symfony (6.3.8) ainsi que l'ORM Doctrine (2.4) pour la gestionde BDD.

La base de données est une MySQL (5.7) qui a été générée et qui est gérée à l'aide de Doctrine

Voice un résumé qui représente les flux lors d'un crawl entre ces différents composants :

1 : Chargement de la page /crawl
2 : Requete vers l'API Datagarden (code getPositions.php du git modèle)
3 : Mise en forme de la réponse Datagarden en page html simple
4 : Stockage dans la base de données du Crawl par l'ORM
5 : Affichage sur la page web du résultat du Crawl


# Axes d'amélioration du projet
- Axe fonctionnalités supplémentaires :
D'autres fonctionnalités peuvent être implémentées comme :
- le déclenchement du Crawl par un bouton plutot qu'au chargement de la page,
- L'affichage de tous les crawl en base de données ou encore avec la possibilité de filtrer,
- l'ajout d'un formulaire pour changer le site à Crawl voir Crawler plusieurs sites,
- La mise en place de Crawl périodique...

- Axe Docker :
Comme sugéré dans l'énoncé du projet, la base de données a été conteneurisée.
Cependant, on aurait pu également conteneurisé le serveur php dans un autre conteneur

- Axe tests :
La mise en place des tests unitaires n'a pas été faite.
J'ai consicence que c'est une partie essentielle du dévelopement que je n'ai pas traitée juste par manque de temps.

- Axe Design :
Ce projet n'a pas du tout vocation du à être "beau". (REFORMULER)

- Axe Git :
Le git de ce projet est basique. Pas de branches, pas de CI/CD, des commits nommés mais sans description.
Pour un "vrai" projet, l'amlioration du git serait un vrai sujet.

- Axe propreté du code :
Mise en place d'un linter.


# Notes personelles :
Le git commence à partir d'un squelette vide Symfony (même si j'ai du exécuter quelques commandes pour le générer correctement).
Une listes de toutes les commandes importantes pour la réalisation du projet se trouve dans le fichier "Commandes.md", elles ne sont pas nécessaires pour utiliser l'application et sont la à titre informatif.
C'est mon premier projet à l'aide de Symfony mais je pense qu'il répond à la problématique et j'espère qu'il refletera mes capacités en php et à apprendre.

Merci d'avance pour votre temps de relecture et j'espère vous revoir pour un entretien bientpot !

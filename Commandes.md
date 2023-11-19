** Créer projet :
composer create-project symfony/skeleton:"6.3.*" projet-cybercite-crawl-tommendez
cd projet-cybercite-crawl-tommendez
composer require webapp

[sudo apt install php-xml]

** Setup ORM :
composer require symfony/orm-pack
composer require --dev symfony/maker-bundle
composer require doctrine


** Modifier .env :
# to use mysql
DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name?serverVersion=5.7"
# to use mariadb:
[DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name?serverVersion=mariadb-10.5.8"]


** Setup bdd docker :
./bin/console make:docker:database  
sudo docker-compose up -d

[sudo docker-compose exec database mysql --password]
[USE main;]

(Arret des conteneurs : sudo docker-compose down)

** Création de l'entityClass, du Controller et des tables :
//// CHANGEMENT DE DB DANS ENV ////
sudo symfony console make:entity
sudo symfony console make:migration
sudo symfony console doctrine:migrations:migrate
sudo symfony console make:controller CrawlController

[Exemple de requete :]
sudo symfony console doctrine:query:sql 'SELECT * FROM crawl'

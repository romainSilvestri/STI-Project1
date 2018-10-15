# STI-Project1
La commande suivante télécharge l’image, lance un conteneur nommé sti_project, relie de manière dynamique le répertoire "site" local avec "/usr/shar/nginx" dans l’image, relie le port 8080 de votre ordinateur hôte vers le port 80 sur votre conteneur et renomme l’hôte virtuel du conteneur comme "sti". Le conteneur est lancé en mode daemon :

docker run -ti -v "$PWD/site":/usr/share/nginx/ -d -p 8080:80 --name sti_project --hostname sti arubinst/sti:project2018

Attention : certaines options peuvent varier en fonction de votre OS hôte. Référez-vous à la documentation.

Vous pouvez changer le port 8080 par un autre port s’il est déjà occupé par un service tournant sur votre machine.

Le répertoire "site" doit contenir un sous-répertoire "html" pour les fichiers de votre application et un sous-répertoire "databases" pour les bases de donnés.

Ensuite, pour lancer les services web et PHP, utiliser les commandes suivantes :

docker exec -u root sti_project service nginx start
docker exec -u root sti_project service php5-fpm start


Si vous avez besoin d’utiliser le conteneur en mode interactif, vous pouvez lancer un shell avec la commande suivante :

docker exec -it sti_project /bin/bash


Attention : l’utilisateur par défaut est labo, mot de passe labo. sudo est actif pour cet utilisateur.

Pour lancer un shell directement comme root :

docker exec -it -u root sti_project /bin/bash


Pour sortir du shell :

exit


Finalement, pour arrêter le conteneur :

docker stop sti_project


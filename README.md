jurazoneprojet

Pour pouvoir installer le projet il est tout d’abord nécessaire
de posséder plusieurs logiciels. Il est nécessaire de
posséder une plateforme de développement web tel que
WAMP ou MAMP. Les logiciels sont téléchargeables ici:
    WAMP: http://www.wampserver.com/
        (Windows)
    MAMP: https://www.mamp.info/en/
        (Windows & Mac OSx)
        
En ce qui concerne linux il est nécessaire d’installer des
logiciels libres tel que Apache MySQL et PHP. Les
instructions sont situées ici :
    http://olange.developpez.com/articles/debian/installationserveur-dedie/?page=page_2
Il est également nécessaire de posséder le logiciel
Composer qui est un gestionnaire de paquets libre écrit en
PHP. Pour installer Composer sur les différents systèmes
d’exploitation il suffit de suivre les instructions (en anglais)
décrites ici 
    https://getcomposer. org/doc/00-intro.md. 
Et bien sûr Laravel, le Framework PHP, cependant ce dernier
sera fourni en même temps que le projet. Pour installer le
projet Laravel il est ensuite nécessaire qu’il vous soit fourni
sous un format de fichier zip. Dézippez le fichier zip dans
le dossier www de votre installation de WAMP ou dans le
htdocs de votre MAMP. Une fois le projet dans le bon
répertoire, il est nécessaire d’installer les requis de
composer pour cela ouvrez l’invite de commande Windows
(en tapant cmd dans la barre de recherche) ou terminal sur
Mac Osx. Déplacer vous jusqu’au dossier est tapez la ligne
de commande suivante :
    • composer install
    
Une fois le dossier vendor installé vous pouvez démarrer
le serveur en faisant cette ligne de commande:
    • php artisan serve
    
Si le résultat est: “Information : impossible de trouver des
fichiers pour le(s) modèle(s) spécifié(s).”, alors il faut
modifier votre PATH. Pour ceci sur Windows il faut: 
Ouvrez le panneau de configuration 
Accédez à Système et sécurité > Système. 
Cliquez sur Paramètres système avancés. 
Dans la nouvelle fenêtre, cliquez sur le bouton "Variables d’environnement"...

Dans la nouvelle fenêtre, double-cliquez sur l’entrée Path
du cadre Variables systèmes Dans la nouvelle fenêtre,
cliquez sur le bouton Nouveau et tapez php, puis appuyer
sur la touche Enter.

Sélectionnez la nouvelle entrée php puis cliquez sur
Parcourir Naviguer jusqu’au dossier où vous avez installé
WAMP Naviguez ensuite dans bin > php. Cliquez sur le
dernier dossier commençant par php7.0. puis cliquez sur
OK.

A ce stade-là votre serveur est en état de démarrer, mais
il vous retournera forcément un site incomplet, car il est
nécessaire d’installer la base de données.

Afin d'effectuer une installation complète du projet, il est
nécessaire d'avoir quelques prérequis :
    - Une plateforme de développement Web (Wamp,
    EasyPHP, Mamp,…)
    - Le dossier complet du projet JuraZone
    
Placer le dossier jurazone dans le répertoire accessible par
votre plateforme de dév. web. (www) Laravel permet gérer
le site web et de remplir automatiquement la base de
données. Cependant il faut d’abord la créer.

Accéder à votre administration de base de données
(PHPMYADMIN) et créer la base de données suivante :
    Nom  jurazone
    Interclassement  utf8mb4_unicode_ci
    
Et créer un compte local qui accède à cette base de
données :
    Nom  jurazone
    Nom de l’hôte  Localhost
    Mot de passe  1234
    
Accéder à la racine du projet JuraZone via l’invite de
commandes (CMD).

Lancer les commandes suivantes :
    php artisan migrate :fresh –seed
Cela va remplir la base de données avec les données
prévues pour les différentes tâches.

Vous pourrez ensuite accéder au site via
jurazoneprojet\public\dist\index.php

Vous pouvez donc vous connecter sur le site via plusieurs
logins :
    Senior :
        Nom  j-m-1004
        Mot de passe  pomme
    Junior :
        Nom  juju18
        Mot de passe  pomme
    Employé :
        Nom  chloe-employe
        Mot de passe  pomme
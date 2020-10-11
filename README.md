# Projets

## WhatZeWeb.com project
https://www.whatzeweb.com/cours/creer-son-premier-blog-en-poo-en-php/

Céation d'un blog en PHP en MVC et POO.
Utilisation de composer.

Dossier **sql** contient les scripts à insérer dans une base de données ***blog***.

Structure des dossiers de l'application:

* <u>config</u> : contient la configuration de l'application
* <u>public</u> : seul dossier accessible à l'utilisateur final.
    - css
    - js
    - fonts
    - img
* <u>src</u> : contient toute la logique de l'application
    - model : classes
    - controller : contrôleurs
    - DAO : managers Data Access Object
    - constraint : contraintes de validation des données
* <u>templates</u> : vues sur l'application

## Installation de Composer :

[Site officiel de Composer](https://getcomposer.org/)

[Détails sur l'installation](https://www.whatzeweb.com/blog/installer-et-utiliser-composer)

Génération des fichiers autoload :
`composer dump-autoload`


### Points d'amélioration du projet
* Ajout de champs pour création de comptes, email unique, password vérification stricte.

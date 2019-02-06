# Exercice à produire

Un blog comprenant 3 types de pages.

- La page d'accueil
- La page article
- La page de création des articles


Chacun produira un projet dans un fork, et poussera une PullRequest le travail terminé.
Vous pouvez travailler à plusieurs pour vous répartir les tâches. 
Vous indiquerez votre ou vos nom(s) dans le readme.
En cas de travail en groupe, je regarderais les commits de chacun.

Je sais que nous n'avons pas eu le temps de voir les templates.
Je vous renvoie vers https://symfony.com/doc/current/controller.html et https://symfony.com/doc/current/templating.html :) 

Bon courage !


## Créer un projet Symfony

S'appuyer sur Symfony 4.

## Créer le modèle

S'appuyer sur l'ORM doctrine.

Vous allez avoir besoin de stocker un article possédant les champs suivants:
- id
- title
- subtitle
- corpus
- createdAt

Vous allez avoir besoin de stocker un tag possédant les champs suivants:
- id
- name

Un article peux avoir plusieurs tags, un tag pourras être utilisé par plusieurs articles.

Créer les entités et les relier à la base de donnée.

## Page de création d'article

La page sera accessible sur l'adresse /blogposts en GET.
Elle comprendra un formulaire permettant de soumettre un nouvel article.

Utiliser la même url mais cette fois ci en POST pour gérer la soumission.
2 controllers différents devront être créé.

Afficher un feedback en cas d'erreur comme de succès.

## Page d'accueil

La page sera accessible sur l'adresse / en GET et comprendra:
Une entête centrée avec le nom de votre blog.
Une liste d'articles centrée avec les titres et sous-titre de chaque article.
Sous chaque sous-titre, un lien vers l'article.


## Page d'article

La page sera accessible sur l'adresse /{id-de-l-article} en GET et comprendra:
Une entête centrée avec le nom de votre blog
Le titre de l'article centré
Le corps de l'article.
Un lien de retour vers la page d'accueil.


### Bonus

Ajouter Une pagination doit se trouver en pied de page.
Ajouter des liens "articles suivants" et "articles précédents".
Verrouiller l'accès à la page de création des articles avec une authentification http basic.
Ajouter un paramètre de Tri par tag.

## Critères

Je regarderai que tout fonctionne comme attendu en lançant la commande `bin/console server:start`.
Je regarderai le respect des PSR.
Je regarderai le respect des bonnes pratiques.
Je regarderai la manière dont les commits ont été fait.
Je regarderai quelles fonctionnalités "bonus" ont été faites.



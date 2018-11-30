# Projet Agence de Voyage Tanguy & Rafeh

## Différences avec le code de base

### Scripts
Trois scripts bash ont été ajoutés pour ne pas avoir à retaper incessament les commandes:

- `check-routes.sh` : liste les routes;
- `load-database.sh` : efface la BDD, reload le schéma et instancie les fixtures; 
- `start-server.sh` : démarre le serveur sur le port `:8000`

(Il faudra peut-être `chmod u+x` les scripts si les permissions passent mal à la copie)

### Fixtures
Les donées des fixtures ne sont pas hard-codées dans les fonctions de chargement. Les données sont dans du JSON `EntityData.json`, et les fonctions `LoadEntityData.php` lisent le JSON puis loadent les données.

### Front-office
Les circuits non programmés ne sont jamais affichés dans le front-office. Ce comportement est volontaire: si un admin voit des circuits non-programmés dans le front-office, rien ne l'empecherait de passer une commande personnelle sur ces circuits sans aucune supervision!

Les données brutes pas encore à la vente sont donc cantonnées au back-office. Il n'y a plus de confusion.

### Section Admin
Lorsqu'un utilisateur n'est pas connecté, un bouton `Login` est visible. Connecté, son nom apparaît dans le bouton.

Si l'utilisateur est un admin, deux boutons (`Circuits` et  `Étapes`) apparaissent.

## Entities
L'entité circuit possède une variable membre `adressePhoto`. Elle référence le nom de la photo dans `/public/images/` associée au circuit.

## Checklist

- [x] prise de connaissance du cahier des charges (TP 3)
- [x] initialisation squelette application Symfony (TP 3)
- [x] ajout au modèle des données des entités liées Circuits et Étapes (TP 3)
- [x] ajout d'un contrôleur pour le front-office (TP 3)
- [x] ajout d'un jeu de gabarits Twig pour la consultation des circuits (TP 3)
- [x] ajout de la consultation des étapes d'un circuit (TP 3)
- [x] ajout de l'entité Circuit Programmé (HP 3-4)
- [x] modification du front-office pour ne consulter que les circuits planifiés (HP 3-4)
- [x] afficher les détails complets des entités dans les pages du front-office (HP 3-4)
- [x] intégration d'une mise en forme CSS avec Bootstrap dans les gabarits Twig (TP 4, HP 4-5)
- [x] ajout de contrôleurs CRUD pour les Étapes et les Circuits, pour le back-office (TP 5)
- [x] ajout de règles de gestion réalistes dans le back-office (HP 5-6)
- [x] finalisation de la gestion du marque-pages/panier dans le front-office (TP 5)
- [] amélioration visuelle des formulaires
- [x] restructuration des pages du front-office pour soigner l'apparence visuelle et l'image du site de l'agence (/front-office) vis-à-vis des clients

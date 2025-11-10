<?php
// Lier le Model au Controller
// J'ai dans ma table sql plusieurs produits. Alt text

// Maintenant que l'on sait que notre Controller fonctionne nous allons rajouter de la logique métier et récupérer un produit en fonction de l'id et le rendre disponible à la vue.

// app/controllers/ProductController.php

require_once(__DIR__ . "/../models/FilmModel.php");
class FilmController
{


    public function view(string $method, array $params = [])
    {
        // Je place la fonction call_user_func dans un try catch 
        // au cas une méthode inconnu est tapée dans l'URL
        try {
            call_user_func([$this, $method], $params);
        } catch (Error $e) {
        }
    }
    public function show(array $params = [])
    {
        // Préparation de la variable $id à afficher dans la vue
        $id = $params[0];

        // Récupération d'un film
        $filmModel = new FilmModel();
        $film = $FilmModel->get($id);


        // Affichage de la vue
        require_once(__DIR__ . "/../views/home.php");
    }
}

<?php require_once(__DIR__ . "/../models/FilmModel.php");

class FilmController
{
    public function view(string $method, array $params = [])
    {
        try {
            // call_user_func_array permet de décomposer le tableau $params en arguments
            if (method_exists($this, $method)) {
                call_user_func_array([$this, $method], $params);
            } else {
                echo "<p>Méthode '$method' introuvable.</p>";
            }
        } catch (Error $e) {
            echo "<p>Erreur : " . $e->getMessage() . "</p>";
        }
    }

    // Affiche tous les films
    public function show(array $params = [])
    {
        $filmModel = new FilmModel();
        $getFilms = $filmModel->getAll(); // récupère tous les films
        console($getFilms);
        // // Rendre les variables accessibles dans la vue
        // $data = ['getFilms' => $getFilms];
        // extract($data);
        //j'aiffiche tous les films dans home.php
        require_once(__DIR__ . "/../views/home.php");
        //le crud de l'admin ci-dessous dans cette view dashboard

    }

    public function dashboard(array $params = []): void
    {
        $filmModel = new FilmModel();
        $getFilms = $filmModel->getAll(); // récupère tous les films
        require_once(__DIR__ . "/../views/admin/dashboard.php");
    }


    public function add(array $params = []): void
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // On traite le formulaire
        $filmModel = new FilmModel();
        $filmModel->add($_POST['nom'], $_POST['date_sortie'], $_POST['genre'], $_POST['auteur']);

     
    }

        require_once(__DIR__ . "/../views/admin/film/add.php");
    }


    public function edit($id): void
    {
        $filmModel = new FilmModel();
        $film = $filmModel->get($id);

        if (!$film) {
            require_once(__DIR__ . "/../views/404.php");
            return;
        }
        require_once(__DIR__ . "/../views/admin/film/edit.php");
    }
    public function delete($id)
    {
        $filmModel = new FilmModel();
        $filmModel->del($id);
        header("Location: /admin/dashboard");
        exit;
    }

    // public function store()
    // {
    //     $filmModel = new FilmModel();
    //     $filmModel->add($_POST['nom'], $_POST['date_sortie'], $_POST['genre'], $_POST['auteur']);
    //     header("Location: /admin/dashboard");
    //     exit;
    // }
}

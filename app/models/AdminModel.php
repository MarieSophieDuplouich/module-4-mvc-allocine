<?php
require_once(__DIR__ . "/../models/FilmModel.php");

class AdminController
{
    public function view(string $method, array $params = [])
    {
        try {
            call_user_func([$this, $method], $params);
        } catch (Error $e) {
            require_once(__DIR__."/../views/404.php");
        }
    }

    public function dashboard()
    {
        $filmModel = new FilmModel();
        $getFilms = $filmModel->getAll(); // récupère tous les films

        require_once(__DIR__."/../views/admin/dashboard.php");
    }

    public function users()
    {
        require_once(__DIR__."/../views/admin/users.php");
    }
}

<?php
class UserController
{
 //ci-dessous méthode qui appelle les routes et en dessous d'elle ce sont ls soeurs
     public function view(string $method, array $params = [])
    {
        // Je place la fonction call_user_func dans un try catch 
        // au cas une méthode inconnu est tapée dans l'URL
        try {
            call_user_func([$this, $method], $params);
        } catch (Error $e) {
            require_once(__DIR__."/../views/404.php");
        }
    }

    // /user/profile
    public function profile()
    {
            require_once(__DIR__."/../views/user/profile.php");
    }
    // /user/settings
    public function settings()
    {
            require_once(__DIR__."/../views/user/settings.php");
    }
}

?>




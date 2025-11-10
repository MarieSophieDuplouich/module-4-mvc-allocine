<!-- Exercices Controller
Créez un controller AdminController avec le CLI nouvellement créé et ajoutez les routes suivantes à l'application :
/admin/dashboard -> AdminController::dashboard
/admin/users -> AdminController::users

Ajoutez un controller UserController avec les routes suivantes :
/user/profile -> UserController::profile
/user/settings -> UserController::settings -->
<?php
class AdminController
{     //ci-dessous méthode qui appelle les routes et en dessous d'elle ce sont ls soeurs
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
    public function dashboard()
    {
 
            require_once(__DIR__."/../views/admin/dashboard.php");
      
    }
    public function users()
    {
    
            require_once(__DIR__."/../views/admin/users.php");
        
    }
}

?>
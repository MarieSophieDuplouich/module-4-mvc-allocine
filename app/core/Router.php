<?php
// Je vais créer les routes /product/... j'ai donc besoin
// de controleur ProductController
// require_once(__DIR__."/../controllers/ProductController.php");

// class Router{
//     public static function getController(string $controllerName){
//         switch ($controllerName) {
//             // Si la route est /product 
//             case 'product':
//                 // Je renvoi le controleur ProductController
//                 return new ProductController();
//                 break;
//             default:
//                 break;
//         }
//     }
// }


// ici c'est pour les 404 si l'admin par ex disparaît il faut la mettre
require_once(__DIR__ . "/../controllers/ProductController.php");
require_once(__DIR__ . "/../controllers/HomeController.php");
require_once(__DIR__ . "/../controllers/AdminController.php");
require_once(__DIR__ . "/../controllers/UserController.php");
require_once(__DIR__ . "/../controllers/FilmController.php");
require_once(__DIR__ . "/../controllers/NotFoundController.php");

class Router
{
    public static function getController(string $controllerName)
    {
        switch ($controllerName) {
            case 'product':
                return new ProductController();

            case '':
                return new HomeController();
                break;
            case 'user':
                return new UserController();
                break;
            case 'admin':
                return new AdminController();
                break;
            case 'film':
                return new FilmController();
                break;
            default:
                // Si aucune route de match
                return new NotFoundController();
                break;
        }
    }
}

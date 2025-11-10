<?php
// class App{
//     public static function start(){
//         echo "App";
//     }
// }
// require_once(__DIR__."/../models/ProductModel.php");
// require_once(__DIR__."/../controllers/ProductController.php");
require_once(__DIR__ . "/Router.php");
require_once(__DIR__ . "/../models/FilmModel.php"); // Assure-toi que ce fichier existe

const ROOT_APP_PATH = "module-4-mvc-allocine";


class App
{
    public static function start()
     {   
        
        // Voilà ! Votre MVC est fonctionnel ! Il ne reste plus qu'à corriger deux soucis pour que tout soit bon :

// La route / ne corresepond à aucune vue et donc une erreur apparait dans la fonction view si j'écrit juste localhost. 
// Il nous faut enfaite une page d'accueil.
// // Il faut afficher une vue erreur 404 si la route écrite n'existe pas.
// Note : Le framework n'effecte presque aucune vérification d'erreur. C'est volontaire pour la simplicité du cours.
        
        
        // routing début

     $uri = str_replace(ROOT_APP_PATH,"",$_SERVER["REQUEST_URI"]);

        $uri_elements = explode("/",$uri);

        $controllerName = isset($uri_elements[1])?$uri_elements[1]:"";
        $methodName = isset($uri_elements[2])?$uri_elements[2]:"";
        $params = array_splice($uri_elements,3);

        // Je récupère le controller
        $controller = Router::getController($controllerName);

        // Appel de la méthode view 
        // La méthode view va executer la méthode en fonction de l'url
        $controller->view($methodName,$params);

        /**
         * Récupère l'uri.
         */
        // $uri = $_SERVER["REQUEST_URI"];

        // /**
        //  * Récupère un tableau des élements de l'uri en séparant
        //  * la string via le caractère '/'
        //  */
        // $uri_elements = explode("/", $uri);
        // // Pour l'uri /product/show/3
        // // $uri_elements  => ["","product","show","3"]

        // $controllerName = $uri_elements[1] ?? "";
        // $methodName = $uri_elements[2] ?? "";
        // // supprime les 3 premiers éléments pour ne conserver que les paramètres
        // $params = array_splice($uri_elements, 3);
        // // Pour l'uri /product/show/3
        // // $params => ["3"]
        // // Pour l'uri /product/show/3/4/5
        // // $params => ["3","4","5"]

        // // sans les echos je ne vois rien sinon
        // echo "<h2>On arrive à récupérer les paramètres de l'URL !</h2>";
        // echo "<p>Controller : $controllerName</p>";
        // echo "<p>Méthode : $methodName</p>";
        // echo "<p>Params : " . implode(", ", $params) . "</p>";

        // console($controllerName);
        // console($methodName);
        // console($params);




        //fin routing


        //      $controller = Router::getController("product");
        //     $controller->show([3]);


        //       $controller = new ProductController();
        //     $controller->show([3]);
        //     $productModel = new ProductModel();

        //     // poursavoir si mon crud fonctionne
            //    $productModel->add(name:"brosses",price:88,image:"http://unsplash.it/100/200");
            //            $productModel->del(id:3);



//     // poursavoir si mon crud fonctionne
//             // --- TEST CRUD ---
// $filmModel = new FilmModel(); // création de l’objet

// try {
// $filmModel->add(
//     nom: "Harry Potter",
//     date_sortie: "2000-01-01",
//     genre: "Horreur",
//     auteur: "JK Rowling"
// );

//     $filmModel->del(id: 1);

//     echo "<p>CRUD exécuté avec succès ✅</p>";
// } catch (Exception $e) {
//     echo "<p style='color:red;'>Erreur : " . $e->getMessage() . "</p>";
// }




        //        $product =  $productModel->get(id:1);
        //        console($product);

        //            $productModel->edit(id:3,name:"Tommy Hilfinger",
        // price:120,image:"http://unsplash/100/110"); 

        //     $products = $productModel->getAll();



        //     // $productModel->edit(id:1,price:39);
        //     foreach($products as $product){
        //         // Product est du type ProductEntity
        //         console($product->getName());
        // attention à bien ajouter des lignes dans la table Produit
        // }
    }
}

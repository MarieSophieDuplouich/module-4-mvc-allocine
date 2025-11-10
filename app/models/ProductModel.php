<?php
class ProductModel{

    private PDO $bdd;
    private PDOStatement $getProducts;
      private PDOStatement $getProduct;
     private PDOStatement $addProduct;
    private PDOStatement $delProduct;
  
    private PDOStatement $editProduct;
    //exos crud  
    function __construct()
    {
        // Connection à la base de donnée
        $this->bdd = new PDO("mysql:host=bdd;dbname=app-database","root","root");
        // Création d'une requête préparée qui récupère tout les produits
        $this->getProducts = $this->bdd->prepare("SELECT * FROM 
        `Produit` LIMIT :limit");

        $this->getProduct = $this->bdd->prepare("SELECT * FROM Produit WHERE id = :id");
        $this->addProduct = $this->bdd->prepare("INSERT INTO Produit (name, price, image) VALUES (:name, :price, :image)");
        $this->delProduct = $this->bdd->prepare("DELETE  FROM Produit WHERE id =:id");
         $this->editProduct = $this->bdd->prepare("UPDATE Produit SET  name = :name, price = :price, image = :image WHERE id = :id");
        
    }

    /**
     * Renvoi les 50 premiers produits 
     * */
    public function getAll(int $limit = 50) : array
    {
        // Définir la valeur de LIMIT, par défault 50
        // LIMIT étant un INT ont n'oublie pas de préciser le type PDO::PARAM_INT.
        $this->getProducts->bindValue("limit",$limit,PDO::PARAM_INT);
        // Executer la requête
        $this->getProducts->execute();
        // Récupérer la réponse 
        $rawProducts = $this->getProducts->fetchAll();
        
        // Formater la réponse dans un tableau de ProductEntity
        $productsEntity = [];
        foreach($rawProducts as $rawProduct){
            $productsEntity[] = new ProductEntity(
                $rawProduct["name"],
                $rawProduct["price"],
                $rawProduct["image"],
                $rawProduct["id"]
            );
        }
        
        // Renvoyer le tableau de ProductEntity
        return $productsEntity;
    }

    /**
     * Recupérer un produit via son id.
     * @return ProductEntity ou NULL si aucune ne correspond à l'$id
     * @param int id : la clé primaire de l'entity demandée.
     * */
    public function get(int $id): ProductEntity | NULL
    {
      $this->getProduct->execute([':id' => $id]);
        $rawProduct = $this->getProduct->fetch(PDO::FETCH_ASSOC);

        if (!$rawProduct) {
            return null;
        }

        return new ProductEntity(
            $rawProduct["name"],
            (float)$rawProduct["price"],
            $rawProduct["image"],
            (int)$rawProduct["id"]
        );
   
    }

    /**
     * Ajouter un produit
     * @return void : ne renvoi rien
     * les informations de l'entity
     * */
    public function add(string $name, float $price,string $image) : void
    {   
       $this->addProduct->execute([
            ':name' => $name,
            ':price' => $price,
            ':image' => $image
        ]);
    }

    /**
     * Supprime un produit via son id
     * @return void : ne renvoi rien
     * @param int $id : la clé primaire de l'entité à supprimer
     * */
    public function del(int $id) : void
    {
       $this->delProduct->execute([':id' => $id]);
    }

    /**
     * Modifier un produit
     * @return ProductEntity ou NULL : Le produit modifié après modification ou NULL si l'id n'existe pas.
     * @param int $id l'identifiant du produit, ce paramètre ne défini pas la nouvelle valeur de l'id car un id SQL est immuable, mais permet de définir quelle produit modifier.
     * */
    public function edit(int $id,string $name,
    float $price, string $image) : ProductEntity | NULL
    {
     $this->editProduct ->execute([
            ':id' => $id,
            ':name' => $name,
            ':price' => $price,
            ':image' => $image
        ]);

        return $this->get($id);
        // return $this->getProduct->execute()->fetch()
    }
  
}



//entity

class ProductEntity
{  //champs sql

    private $name;
    private $price;
    private $image;
    private $id;
//LOGIQUE MÉTIER
    private const NAME_MIN_LENGTH = 3;
    private const PRICE_MIN = 0;
    private const DEFAULT_IMG_URL = "/public/images/default.png";
//CONSTRUCTEUR
        function __construct(string $name, float $price, string $image, int $id = NULL)
    {
        $this->setName($name);
        $this->setPrice($price);
        $this->setImage($image);
        $this->id = $id;
    }

//SETTERS
    public function setName(string $name)
    {
        if (strlen($name) < $this::NAME_MIN_LENGTH) {
            throw new Error("Name is too short minimum 
            length is " . $this::NAME_MIN_LENGTH);
        }
        $this->name = $name;
    }
    public function setPrice(float $price)
    {
        if ($price < 0) {
            throw new Error("Price is too short minimum price is " . $this::PRICE_MIN);
        }
        $this->price = $price;
    }
    public function setImage(string $image)
    {
        if (strlen($image) <= 0) {
            $this->image = $this::DEFAULT_IMG_URL;
        }
        $this->image = $image;
    }

    //GETTERS
    public function getName(): string
    {
        return $this->name;
    }
    public function getPrice(): float
    {
        return $this->price;
    }
    public function getImage(): string
    {
        return $this->image;
    }
    public function getId(): int
    {
        return $this->id;
    }


}

// ProductEntity
// Une entité represente une ligne de la table. 
// Malgré son nombres de lignes vous verrez que cette 
// classe ne contient en faite que des getter et des setters
// c'est à dire des méthodes publiques pour définir les attributs de l'objet.

// Cette classe nous servira de type de reference pour les lignes d'une table.

// Dans la classe ProductEntity ajoutez les méthodes 
// getter et les attributs de l'entité. Une méthode getter 
// est une méthode publique qui permet d'accéder au attributs de l'objet.
// app/models/ProductModel.php 

// Dans la classe ProductEntity ajoutez maintenant les méthodes 
// setter qui permettent de définir les valeurs d'une entité. Ainsi que des constantes néccessaires au test dans les setters.
// app/models/ProductModel.php

// Et pour finir le constructeur pour attribuer une valeur aux attributs à la création d'une entité.

// class ProductEntity{
//    // ...
//     function __construct(string $name,float $price,string $image,int $id=NULL)
//     {
//         $this->setName($name);
//         $this->setPrice($price);
//         $this->setImage($image);
//         $this->id = $id;
//     }
//    // ...
// }
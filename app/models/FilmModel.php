<?php

class FilmModel
{

    private PDO $bdd;
    private PDOStatement $getFilms;
    private PDOStatement $getFilm;
    private PDOStatement $addFilm;
    private PDOStatement $delFilm;

    private PDOStatement $editFilm;
    //exos crud  
    function __construct()
    {
        // Connection à la base de donnée
        $this->bdd = new PDO("mysql:host=bdd;dbname=app-database", "root", "root");
        // Création d'une requête préparée qui récupère tout les produits
        $this->getFilms = $this->bdd->prepare("SELECT * FROM 
        `Film` LIMIT :limit");

        $this->getFilm = $this->bdd->prepare("SELECT * FROM Film WHERE id = :id");
        $this->addFilm = $this->bdd->prepare("INSERT INTO Film (nom, date_sortie,genre, auteur) VALUES (:nom, :date_sortie,:genre, :auteur)");
        $this->delFilm = $this->bdd->prepare("DELETE  FROM Film WHERE id =:id");
        $this->editFilm = $this->bdd->prepare("UPDATE Film SET  nom = :nom, date_sortie = :date_sortie, genre  = :genre, auteur = :auteur WHERE id = :id");
    }

    /**
     * Renvoi les 50 premiers produits 
     * */
    public function getAll(int $limit = 50): array
    {
        // Définir la valeur de LIMIT, par défault 50
        // LIMIT étant un INT ont n'oublie pas de préciser le type PDO::PARAM_INT.
        $this->getFilms->bindValue("limit", $limit, PDO::PARAM_INT);
        // Executer la requête
        $this->getFilms->execute();
        // Récupérer la réponse 
        $rawFilms = $this->getFilms->fetchAll();

        // Formater la réponse dans un tableau de ProductEntity
        $filmsEntity = [];
        foreach ($rawFilms as $rawfilm) {
            $filmsEntity[] = new FilmEntity(
                $rawFilm["nom"],
                $rawFilm["date_sortie"],
                $rawFilm["genre"],
                $rawFilm["auteur"]
            );
        }

        // Renvoyer le tableau de ProductEntity
        return $filmsEntity;
    }

    /**
     * Recupérer un produit via son id.
     * @return FilmEntity ou NULL si aucune ne correspond à l'$id
     * @param int id : la clé primaire de l'entity demandée.
     * */
    public function get(int $id): FilmEntity | NULL
    {
        $this->getfilm->execute([':id' => $id]);
        $rawFilm = $this->getfilm->fetch(PDO::FETCH_ASSOC);

        if (!$rawFilm) {
            return null;
        }

        return new FilmEntity(
            $rawFilm["nom"],
            $rawFilm["date_sortie"],
            $rawFilm["genre"],
             $rawFilm["auteur"],
            (int)$rawFilm["id"]
        );
    }

    /**
     * Ajouter un produit
     * @return void : ne renvoi rien
     * les informations de l'entity
     * */
    public function add($nom,$date_sortie,$genre,$auteur): void
    {
        $this->addFilm->execute([
            ':nom' => $nom,
            ':date_sortie' => $date_sortie,
            ':genre' => $genre,
            ':auteur' => $auteur
        ]);
    }

    /**
     * Supprime un produit via son id
     * @return void : ne renvoi rien
     * @param int $id : la clé primaire de l'entité à supprimer
     * */
    public function del(int $id): void
    {
        $this->delFilm->execute([':id' => $id]);
    }

    /**
     * Modifier un produit
     * @return FilmEntity ou NULL : Le produit modifié après modification ou NULL si l'id n'existe pas.
     * @param int $id l'identifiant du produit, ce paramètre ne défini pas la nouvelle valeur de l'id car un id SQL est immuable, mais permet de définir quelle produit modifier.
     * */
    public function edit(
        $id,
        $nom,
        $date_sortie,
        $genre,
        $auteur

    ): FilmEntity | NULL {
        $this->editFilm->execute([
            ':id' => $id,
            ':nom' => $nom,
            ':date_sortie' => $date_sortie,
            ':genre' => $genre,
            ':auteur' => $auteur

        ]);

        return $this->get($id);
        // return $this->getProduct->execute()->fetch()
    }
}



//entity

class FilmEntity
{  //champs sql

    private $nom;
    private $date_sortie;
    private $genre;
    private $id;

     private $auteur;

    //LOGIQUE MÉTIER



    // private const NAME_MIN_LENGTH = 3;
    // private const PRICE_MIN = 0;
    // private const DEFAULT_IMG_URL = "/public/images/default.png"; //ancien code 
     private const NAME_MIN_LENGTH = 2;
    private const GENRES_AUTORISES = ['Action', 'Comédie', 'Drame', 'Horreur', 'Animation', 'Documentaire'];



    //CONSTRUCTEUR
    function __construct($nom,$date_sortie,$genre,$auteur, $id)
    {
        $this->setName($nom);
        $this->setDateSortie($date_sortie);
        $this->setGenre($genre);
        $this->setAuteur($auteur);

        $this->id = $id;
    }

    //SETTERS
    public function setName(string $nom)
    {
        if (strlen($nom) < $this::NAME_MIN_LENGTH) {
            throw new Error("Name is too short minimum 
            length is " . $this::NAME_MIN_LENGTH);
        }
        $this->nom = $nom;
    }
    public function setDateSortie($date_sortie)
    {
     
     $timestamp = strtotime($date_sortie);
        if (!$timestamp) {
            throw new Exception("La date de sortie n'est pas valide.");
        }

        // Exemple de règle : la date ne peut pas être dans le futur
        $today = strtotime(date('Y-m-d'));
        if ($timestamp > $today) {
            throw new Exception("La date de sortie ne peut pas être dans le futur.");
        }

        $this->date_sortie = date('Y-m-d', $timestamp);
    }

    public function setGenre(string $genre)
    {
        $genre = ucfirst(strtolower(trim($genre)));

        if (!in_array($genre, self::GENRES_AUTORISES)) {
            throw new Exception("Le genre '$genre' n'est pas autorisé. Genres possibles : " . implode(', ', self::GENRES_AUTORISES));
        }

        $this->genre = $genre;
    }

public function setAuteur(string $auteur): void
    {
        if (empty(trim($auteur))) {
            throw new Exception("Le nom de l'auteur ne peut pas être vide.");
        }

        $this->auteur = trim($auteur);
    }

    //GETTERS
    public function getName(): string
    {
        return $this->nom;
    }
    public function getDateSortie()
    {
        return $this->date_sortie;
    }
    public function getGenre()
    {
        return $this->genre;
    }
      public function getAuteur()
    {
        return $this->auteur;
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